function check_form() {
  if (!document.login_form.id.value) {
    alert("please enter your id");
    document.login_form.id.focus();
    return;
  }

  if (!document.login_form.password.value) {
    alert("please enter your password");
    document.login_form.password.focus();
    return;
  }

  document.login_form.submit();
}

function reset_form() {
  document.login_form.id.value = "";
  document.login_form.password.value = "";
  document.login_form.id.focus();
  return;
}
