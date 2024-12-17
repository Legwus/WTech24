function showModal() {
    var inputField = document.getElementById('someText');
    var myModalElement = document.getElementById('exampleModal');
    myModalElement.querySelector('.modal-body').innerHTML =
        `<p>${inputField.value}</p>`;

}



function c() {

    var input = document.getElementById("floatingInput");

    if (input.value == "1") {  // Check if the value is "1" (as input values are strings)
        input.classList.remove("is-invalid"); // Remove 'is-invalid' class if it exists
        input.classList.add("is-valid");      // Add 'is-valid' class
    } else { 
        input.classList.remove("is-valid");  // Remove 'is-valid' class if it exists
        input.classList.add("is-invalid");   // Add 'is-invalid' class
    }
    
}