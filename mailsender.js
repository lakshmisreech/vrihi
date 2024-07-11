const fname = document.getElementById('fname');
const lname = document.getElementById('lname');
const submit = document.getElementById('submit');

submit.addEventListener('submit',(e)=>{
    e.preventDefault();
    let ebody = `
    <h1>First Name: </h1>${fname.value}
    <br>
    <h1>Last Name: </h1>${lname.value}
    `;

    Email.send({
        Host : "smtp.elasticemail.com",
        Username : "bora1132004@gmail.com",
        Password : "93A48BB2A8EBC794EC1163F2CD611FD8DCC8",
        To : 'ganeshbora1132004@gmail.com',
        From : "bora1132004@gmail.com",
        Subject : "This is the subject",
        Body : "And this is the body"
    }).then(
      message => alert(message)
    );
});