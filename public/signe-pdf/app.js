import * as pdfjsLib from "https://cdn.jsdelivr.net/npm/pdfjs-dist@4.8.69/build/pdf.min.mjs";

pdfjsLib.GlobalWorkerOptions.workerSrc =
  "https://cdn.jsdelivr.net/npm/pdfjs-dist@4.8.69/build/pdf.worker.min.mjs";

const fileInput = document.getElementById("fileInput");
const signatureTextInput = document.getElementById("signatureText");
const fontFamilySelect = document.getElementById("fontFamily");
const fontSizeInput = document.getElementById("fontSize");
const fontSizeValue = document.getElementById("fontSizeValue");
const rotationInput = document.getElementById("rotation");
const rotationValue = document.getElementById("rotationValue");
const placeSignatureBtn = document.getElementById("placeSignatureBtn");
const deleteSignatureBtn = document.getElementById("deleteSignatureBtn");
const downloadBtn = document.getElementById("downloadBtn");
const statusEl = document.getElementById("status");
const viewer = document.getElementById("viewer");
const themeToggle = document.getElementById("themeToggle");

const DOCX_PAGE_WIDTH = 794;
const DOCX_PAGE_HEIGHT = 1123;

const CUSTOM_PDF_FONT_URLS = {
  GreatVibes: "https://cdn.jsdelivr.net/fontsource/fonts/great-vibes@latest/latin-400-normal.ttf",
  Allura: "https://cdn.jsdelivr.net/fontsource/fonts/allura@latest/latin-400-normal.ttf",
  AlexBrush: "https://cdn.jsdelivr.net/fontsource/fonts/alex-brush@latest/latin-400-normal.ttf",
  Sacramento: "https://cdn.jsdelivr.net/fontsource/fonts/sacramento@latest/latin-400-normal.ttf",
  DancingScript: "https://cdn.jsdelivr.net/fontsource/fonts/dancing-script@latest/latin-400-normal.ttf",
};

const customPdfFontBytesCache = new Map();

const THEME_COOKIE_KEY = "spg_theme";

function getCookie(name) {
  const escaped = name.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
  const match = document.cookie.match(new RegExp(`(?:^|; )${escaped}=([^;]*)`));
  return match ? decodeURIComponent(match[1]) : null;
}

function setCookie(name, value, days) {
  const maxAge = days * 24 * 60 * 60;
  document.cookie = `${name}=${encodeURIComponent(value)}; path=/; max-age=${maxAge}; SameSite=Lax`;
}

function applyTheme(theme) {
  const safeTheme = theme === "dark" ? "dark" : "light";
  document.documentElement.setAttribute("data-theme", safeTheme);

  if (themeToggle) {
    const dark = safeTheme === "dark";
    themeToggle.textContent = dark ? "Mode clair" : "Mode sombre";
    themeToggle.setAttribute("aria-pressed", dark ? "true" : "false");
  }
}

function initTheme() {
  const savedTheme = getCookie(THEME_COOKIE_KEY);

  if (savedTheme === "dark" || savedTheme === "light") {
    applyTheme(savedTheme);
    return;
  }

  applyTheme("light");
}

let currentFile = null;
let currentFileType = null;
let originalFileBytes = null;
let pdfRenderMeta = [];
let placingMode = false;
let signatureIdSeq = 1;
let previewSignatureEl = null;
let previewPageIndex = null;

const signatures = [];
let selectedSignatureId = null;
let fontPickerUi = null;

const draftStyle = {
  text: signatureTextInput.value.trim() || "Signature",
  fontFamily: fontFamilySelect.value,
  fontSize: Number(fontSizeInput.value),
  rotation: Number(rotationInput.value),
};

function setStatus(message) {
  statusEl.textContent = message;
}

function toArrayBuffer(bytes) {
  return bytes.buffer.slice(bytes.byteOffset, bytes.byteOffset + bytes.byteLength);
}

async function renderSignatureDataUrl(signature) {
  const scale = 2;
  const paddingX = 8;
  const paddingY = 6;
  const fontSpec = `${signature.fontSize}px ${getDisplayFont(signature.fontFamily)}`;

  if (document.fonts && document.fonts.load) {
    await document.fonts.load(fontSpec, signature.text);
  }

  const tempCanvas = document.createElement("canvas");
  const tempCtx = tempCanvas.getContext("2d");
  tempCtx.font = fontSpec;
  const measured = tempCtx.measureText(signature.text);

  const baseWidth = Math.max(16, Math.ceil(measured.width) + paddingX * 2);
  const baseHeight = Math.max(16, Math.ceil(signature.fontSize * 1.6) + paddingY * 2);

  const baseCanvas = document.createElement("canvas");
  baseCanvas.width = baseWidth * scale;
  baseCanvas.height = baseHeight * scale;

  const baseCtx = baseCanvas.getContext("2d");
  baseCtx.scale(scale, scale);
  baseCtx.clearRect(0, 0, baseWidth, baseHeight);
  baseCtx.font = fontSpec;
  baseCtx.fillStyle = "#111111";
  baseCtx.textBaseline = "middle";
  baseCtx.fillText(signature.text, paddingX, baseHeight / 2);

  const angle = (signature.rotation * Math.PI) / 180;
  const absCos = Math.abs(Math.cos(angle));
  const absSin = Math.abs(Math.sin(angle));
  const rotatedWidth = Math.max(16, Math.ceil(baseWidth * absCos + baseHeight * absSin));
  const rotatedHeight = Math.max(16, Math.ceil(baseWidth * absSin + baseHeight * absCos));

  const rotatedCanvas = document.createElement("canvas");
  rotatedCanvas.width = rotatedWidth * scale;
  rotatedCanvas.height = rotatedHeight * scale;

  const rotatedCtx = rotatedCanvas.getContext("2d");
  rotatedCtx.scale(scale, scale);
  rotatedCtx.clearRect(0, 0, rotatedWidth, rotatedHeight);
  rotatedCtx.translate(rotatedWidth / 2, rotatedHeight / 2);
  rotatedCtx.rotate(angle);
  rotatedCtx.drawImage(baseCanvas, -baseWidth / 2, -baseHeight / 2, baseWidth, baseHeight);

  return {
    dataUrl: rotatedCanvas.toDataURL("image/png"),
    width: rotatedWidth,
    height: rotatedHeight,
  };
}
function getDisplayFont(fontFamily) {
  const map = {
    Helvetica: "Helvetica, Arial, sans-serif",
    TimesRoman: "Times New Roman, serif",
    Courier: "Courier New, monospace",
    GreatVibes: '"Great Vibes", cursive',
    Allura: "Allura, cursive",
    AlexBrush: '"Alex Brush", cursive',
    Sacramento: "Sacramento, cursive",
    DancingScript: '"Dancing Script", cursive',
  };

  return map[fontFamily] || map.Helvetica;
}

function getFontLoadFamily(fontFamily) {
  const map = {
    Helvetica: "Helvetica",
    TimesRoman: "Times New Roman",
    Courier: "Courier New",
    GreatVibes: "Great Vibes",
    Allura: "Allura",
    AlexBrush: "Alex Brush",
    Sacramento: "Sacramento",
    DancingScript: "Dancing Script",
  };

  return map[fontFamily] || "Helvetica";
}

function closeCustomFontPicker() {
  if (!fontPickerUi) return;
  fontPickerUi.wrapper.classList.remove("open");
  fontPickerUi.trigger.setAttribute("aria-expanded", "false");
}

function syncCustomFontPicker() {
  if (!fontPickerUi) return;

  const selectedValue = fontFamilySelect.value;
  const selectedOption = Array.from(fontFamilySelect.options).find((option) => option.value === selectedValue);
  const label = selectedOption ? selectedOption.textContent : selectedValue;
  const family = getDisplayFont(selectedValue);

  fontPickerUi.trigger.textContent = label;
  fontPickerUi.trigger.style.fontFamily = family;
  fontPickerUi.trigger.style.setProperty("font-family", family, "important");

  fontPickerUi.options.forEach((optionButton) => {
    const isSelected = optionButton.dataset.value === selectedValue;
    optionButton.classList.toggle("is-selected", isSelected);
    optionButton.setAttribute("aria-selected", isSelected ? "true" : "false");
  });
}

function initCustomFontPicker() {
  if (fontPickerUi || !fontFamilySelect) return;

  const wrapper = document.createElement("div");
  wrapper.className = "font-picker";

  const trigger = document.createElement("button");
  trigger.type = "button";
  trigger.className = "font-picker__trigger";
  trigger.setAttribute("aria-haspopup", "listbox");
  trigger.setAttribute("aria-expanded", "false");

  const menu = document.createElement("div");
  menu.className = "font-picker__menu";
  menu.setAttribute("role", "listbox");

  const optionButtons = Array.from(fontFamilySelect.options).map((sourceOption) => {
    const button = document.createElement("button");
    button.type = "button";
    button.className = "font-picker__option";
    button.dataset.value = sourceOption.value;
    button.textContent = sourceOption.textContent;
    button.setAttribute("role", "option");

    const family = getDisplayFont(sourceOption.value);
    button.style.fontFamily = family;
    button.style.setProperty("font-family", family, "important");

    button.addEventListener("click", () => {
      if (fontFamilySelect.value !== sourceOption.value) {
        fontFamilySelect.value = sourceOption.value;
        fontFamilySelect.dispatchEvent(new Event("change", { bubbles: true }));
      }
      closeCustomFontPicker();
    });

    menu.appendChild(button);
    return button;
  });

  wrapper.appendChild(trigger);
  wrapper.appendChild(menu);
  fontFamilySelect.insertAdjacentElement("afterend", wrapper);
  fontFamilySelect.classList.add("font-native-hidden");

  fontPickerUi = {
    wrapper,
    trigger,
    menu,
    options: optionButtons,
  };

  trigger.addEventListener("click", () => {
    const opening = !wrapper.classList.contains("open");
    wrapper.classList.toggle("open", opening);
    trigger.setAttribute("aria-expanded", opening ? "true" : "false");
  });

  document.addEventListener("pointerdown", (event) => {
    if (!fontPickerUi) return;
    if (!fontPickerUi.wrapper.contains(event.target)) {
      closeCustomFontPicker();
    }
  });

  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape") {
      closeCustomFontPicker();
    }
  });

  syncCustomFontPicker();
}
function styleFontPicker() {
  const options = Array.from(fontFamilySelect.options);

  options.forEach((option) => {
    const family = getDisplayFont(option.value);
    option.style.fontFamily = family;
    option.style.setProperty("font-family", family, "important");
    option.style.fontWeight = "400";
    option.style.fontStyle = "normal";
  });

  const selectedFamily = getDisplayFont(fontFamilySelect.value);
  fontFamilySelect.style.fontFamily = selectedFamily;
  fontFamilySelect.style.setProperty("font-family", selectedFamily, "important");

  if (fontPickerUi) {
    fontPickerUi.options.forEach((optionButton) => {
      const family = getDisplayFont(optionButton.dataset.value);
      optionButton.style.fontFamily = family;
      optionButton.style.setProperty("font-family", family, "important");
    });
    syncCustomFontPicker();
  }
}

async function hydrateFontPickerStyles() {
  if (document.fonts && document.fonts.ready) {
    await document.fonts.ready;

    const options = Array.from(fontFamilySelect.options);
    await Promise.all(
      options.map((option) =>
        document.fonts.load(`16px "${getFontLoadFamily(option.value)}"`).catch(() => null)
      )
    );
  }

  styleFontPicker();
  requestAnimationFrame(styleFontPicker);
  setTimeout(styleFontPicker, 250);
}

function getPdfFontKey(fontFamily) {
  const map = {
    Helvetica: "Helvetica",
    TimesRoman: "TimesRoman",
    Courier: "Courier",
  };

  return map[fontFamily] || "Helvetica";
}

function isCustomFontFamily(fontFamily) {
  return Boolean(CUSTOM_PDF_FONT_URLS[fontFamily]);
}

async function loadCustomPdfFontBytes(fontFamily) {
  if (customPdfFontBytesCache.has(fontFamily)) {
    return customPdfFontBytesCache.get(fontFamily);
  }

  const url = CUSTOM_PDF_FONT_URLS[fontFamily];
  if (!url) {
    return null;
  }

  const response = await fetch(url, { cache: "no-store" });
  if (!response.ok) {
    throw new Error(`Impossible de charger la police ${fontFamily}.`);
  }

  const bytes = new Uint8Array(await response.arrayBuffer());
  customPdfFontBytesCache.set(fontFamily, bytes);
  return bytes;
}

async function resolvePdfFont(pdfDoc, standardFonts, embeddedFontsByFamily, fontFamily) {
  if (embeddedFontsByFamily.has(fontFamily)) {
    return embeddedFontsByFamily.get(fontFamily);
  }

  if (standardFonts[fontFamily]) {
    embeddedFontsByFamily.set(fontFamily, standardFonts[fontFamily]);
    return standardFonts[fontFamily];
  }

  const isCustom = isCustomFontFamily(fontFamily);

  try {
    if (!window.fontkit && isCustom) {
      return null;
    }

    if (window.fontkit) {
      pdfDoc.registerFontkit(window.fontkit);
    }

    const customBytes = await loadCustomPdfFontBytes(fontFamily);
    if (!customBytes) {
      return isCustom ? null : standardFonts.Helvetica;
    }

    const customFont = await pdfDoc.embedFont(customBytes, { subset: true });
    embeddedFontsByFamily.set(fontFamily, customFont);
    return customFont;
  } catch {
    return isCustom ? null : standardFonts[getPdfFontKey(fontFamily)];
  }
}
function findSignature(id) {
  return signatures.find((item) => item.id === id) || null;
}

function getSelectedSignature() {
  if (selectedSignatureId === null) return null;
  return findSignature(selectedSignatureId);
}

function updateButtonsState() {
  deleteSignatureBtn.disabled = selectedSignatureId === null;
  downloadBtn.disabled = signatures.length === 0;
}

function applySignatureElement(signature) {
  signature.el.textContent = signature.text;
  signature.el.style.fontFamily = getDisplayFont(signature.fontFamily);
  signature.el.style.fontSize = `${signature.fontSize}px`;
  signature.el.style.left = `${signature.x}px`;
  signature.el.style.top = `${signature.y}px`;
  signature.el.style.transform = `translate(-50%, -50%) rotate(${signature.rotation}deg)`;
}

function syncControlsFromSignature(signature) {
  if (!signature) return;
  signatureTextInput.value = signature.text;
  fontFamilySelect.value = signature.fontFamily;
  fontSizeInput.value = String(signature.fontSize);
  rotationInput.value = String(signature.rotation);
  fontSizeValue.textContent = `${signature.fontSize} px`;
  rotationValue.textContent = `${signature.rotation} deg`;
  styleFontPicker();
}

function syncDraftFromControls() {
  draftStyle.text = signatureTextInput.value.trim() || "Signature";
  draftStyle.fontFamily = fontFamilySelect.value;
  draftStyle.fontSize = Number(fontSizeInput.value);
  draftStyle.rotation = Number(rotationInput.value);
  fontSizeValue.textContent = `${draftStyle.fontSize} px`;
  rotationValue.textContent = `${draftStyle.rotation} deg`;
  styleFontPicker();
}

function setSelectedSignature(id) {
  selectedSignatureId = id;

  signatures.forEach((signature) => {
    signature.el.classList.toggle("selected", signature.id === selectedSignatureId);
  });

  const selected = getSelectedSignature();
  if (selected) {
    syncControlsFromSignature(selected);
  }

  updateButtonsState();
}

function removeAllSignatures() {
  signatures.splice(0, signatures.length);
  selectedSignatureId = null;
  signatureIdSeq = 1;
  updateButtonsState();
}

function setPlacingMode(isActive) {
  placingMode = isActive;
  viewer.classList.toggle("placing-mode", placingMode);
  if (!placingMode) {
    hidePlacementPreview();
    clearPageHoverState();
  }
}

function clearPageHoverState() {
  viewer.querySelectorAll(".page.placing-target").forEach((pageEl) => {
    pageEl.classList.remove("placing-target");
  });
}

function resetViewer() {
  viewer.innerHTML = "";
  removeAllSignatures();
  pdfRenderMeta = [];
  originalFileBytes = null;
  placeSignatureBtn.disabled = true;
  setPlacingMode(false);
}

function keepInsidePage(signature, pageEl) {
  signature.x = Math.max(0, Math.min(signature.x, pageEl.clientWidth));
  signature.y = Math.max(0, Math.min(signature.y, pageEl.clientHeight));
}

function ensurePreviewElement() {
  if (previewSignatureEl) return previewSignatureEl;

  const el = document.createElement("div");
  el.className = "signature signature-preview";
  previewSignatureEl = el;
  applyPreviewStyle();
  return previewSignatureEl;
}

function applyPreviewStyle() {
  if (!previewSignatureEl) return;
  previewSignatureEl.textContent = draftStyle.text;
  previewSignatureEl.style.fontFamily = getDisplayFont(draftStyle.fontFamily);
  previewSignatureEl.style.fontSize = `${draftStyle.fontSize}px`;
  previewSignatureEl.style.transform = `translate(-50%, -50%) rotate(${draftStyle.rotation}deg)`;
}

function hidePlacementPreview() {
  if (!previewSignatureEl) return;
  previewSignatureEl.remove();
  previewPageIndex = null;
}

function showPlacementPreview(pageEl, pageIndex, x, y) {
  const preview = ensurePreviewElement();

  if (preview.parentElement !== pageEl) {
    hidePlacementPreview();
    pageEl.appendChild(preview);
  }

  previewPageIndex = pageIndex;
  preview.style.left = `${Math.max(0, Math.min(x, pageEl.clientWidth))}px`;
  preview.style.top = `${Math.max(0, Math.min(y, pageEl.clientHeight))}px`;
}

function createSignatureElement(signature) {
  const el = document.createElement("div");
  el.className = "signature";
  el.dataset.signatureId = String(signature.id);

  let dragging = false;

  const stopInteraction = (pointerId) => {
    dragging = false;
    el.classList.remove("interacting");
    if (typeof pointerId === "number" && el.hasPointerCapture(pointerId)) {
      el.releasePointerCapture(pointerId);
    }
  };

  el.addEventListener("click", (event) => {
    event.stopPropagation();
    setSelectedSignature(signature.id);
  });

  el.addEventListener("pointerdown", (event) => {
    event.stopPropagation();
    dragging = true;
    el.classList.add("interacting");
    setSelectedSignature(signature.id);
    el.setPointerCapture(event.pointerId);
  });

  el.addEventListener("pointermove", (event) => {
    if (!dragging) return;

    const pageEl = viewer.querySelector(`[data-page-index=\"${signature.pageIndex}\"]`);
    if (!pageEl) return;

    const rect = pageEl.getBoundingClientRect();
    signature.x = event.clientX - rect.left;
    signature.y = event.clientY - rect.top;
    keepInsidePage(signature, pageEl);
    applySignatureElement(signature);
  });

  el.addEventListener("pointerup", (event) => {
    stopInteraction(event.pointerId);
  });

  el.addEventListener("pointercancel", (event) => {
    stopInteraction(event.pointerId);
  });

  el.addEventListener("lostpointercapture", () => {
    stopInteraction();
  });

  return el;
}
function addSignature(pageIndex, x, y) {
  const pageEl = viewer.querySelector(`[data-page-index=\"${pageIndex}\"]`);
  if (!pageEl) return;

  const signature = {
    id: signatureIdSeq,
    text: draftStyle.text,
    fontFamily: draftStyle.fontFamily,
    fontSize: draftStyle.fontSize,
    rotation: draftStyle.rotation,
    pageIndex,
    x,
    y,
    el: null,
  };

  signatureIdSeq += 1;
  signature.el = createSignatureElement(signature);

  keepInsidePage(signature, pageEl);
  applySignatureElement(signature);
  pageEl.appendChild(signature.el);

  signatures.push(signature);
  setSelectedSignature(signature.id);
  setStatus("Signature ajoutee. Clique sur une signature pour l'editer.");
}

function activatePlacingMode() {
  setPlacingMode(true);
  setStatus("Place la signature: deplace la souris sur la page, puis clique pour deposer.");
}

function wirePageForPlacement(pageEl, pageIndex) {
  pageEl.addEventListener("mouseenter", () => {
    if (!placingMode) return;
    pageEl.classList.add("placing-target");
  });

  pageEl.addEventListener("mouseleave", () => {
    pageEl.classList.remove("placing-target");
    if (!placingMode) return;
    if (previewPageIndex === pageIndex) {
      hidePlacementPreview();
    }
  });

  pageEl.addEventListener("mousemove", (event) => {
    if (!placingMode) return;

    const rect = pageEl.getBoundingClientRect();
    const x = event.clientX - rect.left;
    const y = event.clientY - rect.top;
    showPlacementPreview(pageEl, pageIndex, x, y);
  });

  pageEl.addEventListener("click", (event) => {
    if (!placingMode) return;

    const rect = pageEl.getBoundingClientRect();
    const x = event.clientX - rect.left;
    const y = event.clientY - rect.top;

    addSignature(pageIndex, x, y);
    setPlacingMode(false);
    updateButtonsState();
  });
}

async function renderPdf(arrayBuffer) {
  const pdf = await pdfjsLib.getDocument({ data: arrayBuffer }).promise;
  viewer.innerHTML = "";
  pdfRenderMeta = [];

  for (let i = 1; i <= pdf.numPages; i += 1) {
    const page = await pdf.getPage(i);
    const baseViewport = page.getViewport({ scale: 1 });
    const availableWidth = Math.max(280, viewer.clientWidth - 32);
    const responsiveScale = Math.min(1.4, availableWidth / baseViewport.width);
    const viewport = page.getViewport({ scale: responsiveScale });

    const pageEl = document.createElement("div");
    pageEl.className = "page";
    pageEl.dataset.pageIndex = String(i - 1);
    pageEl.style.width = `${viewport.width}px`;
    pageEl.style.height = `${viewport.height}px`;

    const canvas = document.createElement("canvas");
    const context = canvas.getContext("2d");
    canvas.width = Math.floor(viewport.width);
    canvas.height = Math.floor(viewport.height);
    pageEl.appendChild(canvas);

    await page.render({ canvasContext: context, viewport }).promise;

    viewer.appendChild(pageEl);
    wirePageForPlacement(pageEl, i - 1);

    const { width: pdfWidth, height: pdfHeight } = page.getViewport({ scale: 1 });
    pdfRenderMeta.push({
      pageIndex: i - 1,
      renderWidth: viewport.width,
      renderHeight: viewport.height,
      pdfWidth,
      pdfHeight,
    });
  }

  placeSignatureBtn.disabled = false;
  setStatus("PDF charge. Clique sur 'Ajouter une signature'.");
}

function createDocxPage(pageIndex) {
  const pageEl = document.createElement("div");
  pageEl.className = "page docx-page";
  pageEl.dataset.pageIndex = String(pageIndex);
  wirePageForPlacement(pageEl, pageIndex);
  return pageEl;
}

async function renderDocx(arrayBuffer) {
  viewer.innerHTML = "";
  const result = await mammoth.convertToHtml({ arrayBuffer });

  const source = document.createElement("div");
  source.innerHTML = result.value;

  const nodes = Array.from(source.childNodes).map((node) => node.cloneNode(true));

  let pageIndex = 0;
  let currentPage = createDocxPage(pageIndex);
  viewer.appendChild(currentPage);

  for (const node of nodes) {
    currentPage.appendChild(node);

    if (currentPage.scrollHeight > currentPage.clientHeight) {
      currentPage.removeChild(node);
      pageIndex += 1;
      currentPage = createDocxPage(pageIndex);
      viewer.appendChild(currentPage);
      currentPage.appendChild(node);
    }
  }

  placeSignatureBtn.disabled = false;
  setStatus("DOCX charge. Clique sur 'Ajouter une signature'.");
}

async function exportSignedPdf() {
  if (signatures.length === 0) {
    throw new Error("Ajoute au moins une signature avant de telecharger.");
  }

  const { PDFDocument, StandardFonts, rgb, degrees } = PDFLib;
  const pdfDoc = await PDFDocument.load(originalFileBytes.slice());
  const pages = pdfDoc.getPages();

  const standardFonts = {
    Helvetica: await pdfDoc.embedFont(StandardFonts.Helvetica),
    TimesRoman: await pdfDoc.embedFont(StandardFonts.TimesRoman),
    Courier: await pdfDoc.embedFont(StandardFonts.Courier),
  };
  const embeddedFontsByFamily = new Map();

  for (const signature of signatures) {
    const targetPage = pages[signature.pageIndex];
    if (!targetPage) continue;

    const meta = pdfRenderMeta.find((item) => item.pageIndex === signature.pageIndex);
    if (!meta) continue;

    const xRatio = signature.x / meta.renderWidth;
    const yRatio = signature.y / meta.renderHeight;
    const pdfPointX = xRatio * meta.pdfWidth;
    const pdfPointY = meta.pdfHeight - yRatio * meta.pdfHeight;

    const uiPx = Number(signature.fontSize) || 12;
    const pdfFontSize = Math.max(6, (uiPx / meta.renderWidth) * meta.pdfWidth);

    const resolvedFont = await resolvePdfFont(pdfDoc, standardFonts, embeddedFontsByFamily, signature.fontFamily);

    if (resolvedFont) {
      const textWidth = resolvedFont.widthOfTextAtSize(signature.text, pdfFontSize);
      const textHeight = resolvedFont.heightAtSize(pdfFontSize, { descender: true });

      targetPage.drawText(signature.text, {
        x: pdfPointX - textWidth / 2,
        y: pdfPointY - textHeight / 2,
        size: pdfFontSize,
        font: resolvedFont,
        color: rgb(0.05, 0.05, 0.05),
        rotate: degrees(-(signature.rotation || 0)),
      });
      continue;
    }

    const rendered = await renderSignatureDataUrl(signature);
    const pngImage = await pdfDoc.embedPng(rendered.dataUrl);

    const scaleX = meta.pdfWidth / meta.renderWidth;
    const scaleY = meta.pdfHeight / meta.renderHeight;
    const drawWidth = rendered.width * scaleX;
    const drawHeight = rendered.height * scaleY;
    const drawX = (signature.x - rendered.width / 2) * scaleX;
    const drawY = meta.pdfHeight - (signature.y + rendered.height / 2) * scaleY;

    targetPage.drawImage(pngImage, {
      x: drawX,
      y: drawY,
      width: drawWidth,
      height: drawHeight,
    });
  }

  const bytes = await pdfDoc.save();
  downloadBlob(bytes, buildOutputName(currentFile.name, "signed.pdf"));
}

async function exportSignedDocxAsPdf() {
  if (signatures.length === 0) {
    throw new Error("Ajoute au moins une signature avant de telecharger.");
  }

  const pageEls = Array.from(viewer.querySelectorAll(".docx-page"));
  if (pageEls.length === 0) {
    throw new Error("Apercu DOCX introuvable.");
  }

  const { jsPDF } = window.jspdf;
  const pdf = new jsPDF("p", "mm", "a4");

  for (let i = 0; i < pageEls.length; i += 1) {
    const canvas = await html2canvas(pageEls[i], {
      scale: 2,
      useCORS: true,
      backgroundColor: "#ffffff",
      width: DOCX_PAGE_WIDTH,
      height: DOCX_PAGE_HEIGHT,
    });

    const imageData = canvas.toDataURL("image/png");
    const pageWidth = 210;
    const pageHeight = 297;

    if (i > 0) {
      pdf.addPage();
    }

    pdf.addImage(imageData, "PNG", 0, 0, pageWidth, pageHeight);
  }

  pdf.save(buildOutputName(currentFile.name, "signed.pdf"));
}

function buildOutputName(originalName, suffix) {
  const dotIndex = originalName.lastIndexOf(".");
  const base = dotIndex > 0 ? originalName.slice(0, dotIndex) : originalName;
  return `${base}-${suffix}`;
}

function downloadBlob(bytes, filename) {
  const blob = new Blob([bytes], { type: "application/pdf" });
  const url = URL.createObjectURL(blob);
  const link = document.createElement("a");
  link.href = url;
  link.download = filename;
  link.click();
  URL.revokeObjectURL(url);
}

function updateSelectedSignatureFromControls() {
  syncDraftFromControls();
  applyPreviewStyle();

  const selected = getSelectedSignature();
  if (!selected) return;

  selected.text = draftStyle.text;
  selected.fontFamily = draftStyle.fontFamily;
  selected.fontSize = draftStyle.fontSize;
  selected.rotation = draftStyle.rotation;
  applySignatureElement(selected);
}

function removeSelectedSignature() {
  if (selectedSignatureId === null) return;

  const index = signatures.findIndex((item) => item.id === selectedSignatureId);
  if (index < 0) return;

  const [removed] = signatures.splice(index, 1);
  removed.el.remove();

  if (signatures.length > 0) {
    setSelectedSignature(signatures[signatures.length - 1].id);
  } else {
    selectedSignatureId = null;
    updateButtonsState();
  }

  setStatus("Signature supprimee.");
}

fileInput.addEventListener("change", async (event) => {
  const [file] = event.target.files;
  if (!file) return;

  resetViewer();
  currentFile = file;
  const ext = file.name.split(".").pop().toLowerCase();

  if (ext === "doc") {
    setStatus("Le format .doc n'est pas supporte en mode navigateur. Utilise .docx ou .pdf.");
    return;
  }

  if (ext !== "pdf" && ext !== "docx") {
    setStatus("Format non supporte. Charge un PDF ou un DOCX.");
    return;
  }

  currentFileType = ext;
  const loadedBytes = new Uint8Array(await file.arrayBuffer());
  originalFileBytes = loadedBytes;

  try {
    if (ext === "pdf") {
      await renderPdf(originalFileBytes.slice());
    } else {
      await renderDocx(toArrayBuffer(originalFileBytes.slice()));
    }

    updateButtonsState();
  } catch (error) {
    setStatus(`Erreur de chargement: ${error.message}`);
    placeSignatureBtn.disabled = true;
  }
});

placeSignatureBtn.addEventListener("click", () => {
  if (!currentFileType) return;
  activatePlacingMode();
});

deleteSignatureBtn.addEventListener("click", () => {
  removeSelectedSignature();
});

downloadBtn.addEventListener("click", async () => {
  if (!currentFileType) return;

  try {
    setStatus("Generation du document signe...");

    if (currentFileType === "pdf") {
      await exportSignedPdf();
    } else {
      await exportSignedDocxAsPdf();
    }

    setStatus("Document signe telecharge.");
  } catch (error) {
    setStatus(`Erreur pendant l'export: ${error.message}`);
  }
});

signatureTextInput.addEventListener("input", updateSelectedSignatureFromControls);
fontFamilySelect.addEventListener("change", updateSelectedSignatureFromControls);
fontSizeInput.addEventListener("input", updateSelectedSignatureFromControls);
rotationInput.addEventListener("input", updateSelectedSignatureFromControls);

initCustomFontPicker();
syncDraftFromControls();
styleFontPicker();
hydrateFontPickerStyles();
updateButtonsState();
window.addEventListener("beforeunload", () => {
  resetViewer();
  fileInput.value = "";
  currentFile = null;
  currentFileType = null;
  originalFileBytes = null;
});

window.addEventListener("pageshow", (event) => {
  if (event.persisted) {
    window.location.reload();
  }
});
if (themeToggle) {
  themeToggle.addEventListener("click", () => {
    const current = document.documentElement.getAttribute("data-theme") === "dark" ? "dark" : "light";
    const next = current === "dark" ? "light" : "dark";
    applyTheme(next);
    setCookie(THEME_COOKIE_KEY, next, 365);
  });
}

initTheme();









