function showModal() {
    var username= document.getElementById("usern").innerHTML;
    var myModalElement = document.getElementById('exampleModal1');
    myModalElement.querySelector('.modal-body').innerHTML =
        `<p>Willst du die Freundschaft mit ${username} wirklich beenden?</p>`;

}



