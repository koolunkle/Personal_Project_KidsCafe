function set_question_answer() {
  let question = document.querySelectorAll("table td a");

  for (let i = 0; i < question.length; i++) {
    question[i].addEventListener("click", () => {
      if (document.querySelector(".A" + i).style.display === "") {
        document.querySelector(".A" + i).style.display = "none";
      } else {
        document.querySelector(".A" + i).style.display = "";
      }
    });
  }
}
