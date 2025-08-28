function addCopyListeners() {
  document.querySelectorAll(".copy-btn").forEach((btn) => {
    btn.addEventListener("click", function () {
      const text = this.getAttribute("data-text");
      navigator.clipboard.writeText(text).then(() => {
        this.innerHTML = '<i class="fas fa-check"></i>';
        setTimeout(() => {
          this.innerHTML = '<i class="fas fa-copy"></i>';
        }, 2000);
      });
    });
  });
}

export default addCopyListeners;
