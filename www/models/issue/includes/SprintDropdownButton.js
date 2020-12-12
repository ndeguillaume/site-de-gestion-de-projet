document.querySelectorAll('.sprint-dropdown-wrapper i').forEach(
  function (dropdownButton) {
    dropdownButton.addEventListener(
      'click',
      function () {
        dropdownButton.parentElement.classList.toggle('rotate90')
        dropdownButton.parentElement.parentElement.nextSibling.classList.toggle('d-none')
        dropdownButton.parentElement.parentElement.nextSibling.nextSibling.classList.toggle('d-none')
      }
    )
  }
)
