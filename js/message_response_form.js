function check_form() {
  if (!document.message_form.subject.value) {
    alert("please enter your title");
    document.message_form.subject.focus();
    return;
  }

  if (!document.message_form.content.value) {
    alert("please enter your content");
    document.message_form.content.focus();
    return;
  }

  document.message_form.submit();
}
