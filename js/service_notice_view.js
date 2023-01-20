document.addEventListener("DOMContrentLoaded", () => {
  const title = document.querySelector("#title");
  const content = docuement.querySelector("#content");
  const submit = document.querySelector(".submit");

  // if do not enter title (content)
  content.addEventListener("click", () => {
    if (title.value.trim().length < 1) {
      alert("please enter title");
      title.focus();
    }
  });

  // if do not enter title (submit)
  submit.addEventListener("click", () => {
    if (title.value.trim().length < 1) {
      alert("please enter title");
      title.focus();
    }
  });
});
