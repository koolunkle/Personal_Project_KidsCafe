function check_form() {
  if (!document.register_modify_form.password.value) {
    alert("please enter your password");
    document.register_modify_form.password.focus();
    return;
  }

  if (!document.register_modify_form.password_confirm.value) {
    alert("please enter your password confirm");
    document.register_modify_form.password_confirm.focus();
    return;
  }

  if (!document.register_modify_form.name.value) {
    alert("please enter your name");
    document.register_modify_form.name.focus();
    return;
  }

  if (!document.register_modify_form.email.value) {
    alert("please enter your email");
    document.register_modify_form.email.focus();
    return;
  }

  if (
    document.register_modify_form.password.value !=
    document.register_modify_form.password_confirm.value
  ) {
    alert("password does not match\nplease re-enter");
    document.register_modify_form.password.focus();
    document.register_modify_form.password.select();
    return;
  }

  document.register_modify_form.submit();
}

function reset_form() {
  document.register_modify_form.password.value = "";
  document.register_modify_form.password_confirm.value = "";
  document.register_modify_form.name.value = "";
  document.register_modify_form.email.value = "";
  document.register_modify_form.password.focus();
  return;
}
