function searchbar() {

    let input = document.getElementById('searchbar');
    let filter = input.value.toUpperCase();
    let list = document.querySelector('#playersList');
    let label = list.getElementsByTagName('label');
  
    for (let i = 0; i < label.length; i++) {
      let txtValue = label[i].textContent || label[i].innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        label[i].style.display = "";
      } else {
        label[i].style.display = "none";
      }
    }
}

let checkboxs = document.querySelectorAll('.form-check-input');

for (const box of checkboxs) {
    box.addEventListener('click', handleRemoveText);
}

function handleRemoveText(event) {
    let divInProgress = document.querySelector('.inProgress');
    divInProgress.classList.remove('d-none');
    inProgress(event.currentTarget.parentElement.textContent);
    let input = document.getElementById('searchbar');
    input.value = "";
    searchbar();
    let buttons = document.querySelectorAll('.sendFriends');
    for (const button of buttons) {
        button.classList.remove('d-none');
    }

}

function inProgress(nameToAdd) {
    let ul = document.querySelector('.toAdd');
    let li = document.createElement('li');
    li.textContent = nameToAdd;
    ul.append(li);
}