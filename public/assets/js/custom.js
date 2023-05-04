const adminCheckbox = document.getElementById('basicPlanMain1');
const profCheckbox = document.getElementById('basicPlanMain2');
const hrCheckbox = document.getElementById('basicPlanMain3');
const parentDiv = document.querySelector('.custom-option');


adminCheckbox.addEventListener('click', function () {
    if (adminCheckbox.checked) {
        console.log('yes')
    } else {
        console.log('no')
    }
})

// function showBorder() {
//     parentDiv
// }

