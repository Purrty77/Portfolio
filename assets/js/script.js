
  document.getElementById("scrollBtn").addEventListener("click", function () {
    document.getElementById("myTargetSection").scrollIntoView({
      behavior: "smooth"
    });
  });


window.addEventListener('load', function () {
    setTimeout(function () {
      const toastEl = document.getElementById('myToast');
      const toast = new bootstrap.Toast(toastEl);
      toast.show();
    }, 2000); // 2000 ms = 2 seconds
});


  const text = "Web Developer";
  let i = 0;

  function typeWriter() {
    if (i < text.length) {
      document.getElementById("type-js-text").textContent += text.charAt(i);
      i++;
      setTimeout(typeWriter, 100); // adjust typing speed here (ms)
    }
  }

  typeWriter(); // start the effect