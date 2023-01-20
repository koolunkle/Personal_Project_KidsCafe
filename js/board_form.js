function check_form() {
  if (!document.board_form.subject.value) {
    alert("please enter your title");
    document.board_form.subject.focus();
    return;
  }

  if (!document.board_form.content.value) {
    alert("please enter your content");
    document.board_form.content.focus();
    return;
  }

  document.board_form.submit();
}
