

const ls_findStudent = () =>{
    
    const getInputValue = document.getElementById('ls-findstudent').value;
    const XMLHttp = new XMLHttpRequest();

    XMLHttp.onload = () => {
        console.log(XMLHttp.responseText);
    }

    XMLHttp.open('GET', '/findstudent');
    XMLHttp.setRequestHeader('X-CSRF-TOKEN', )
    XMLHttp.setRequestHeader('Content-Type', 'application/json');
    XMLHttp.send({name : getInputValue});
}