const ls_findStudent = () => {
    const getInputValue = document.getElementById('ls-findstudent').value;
    $.ajax(
        {
            url : "/findstudent",
            type : "GET",
            data : {name : getInputValue},
            success : (response) => {                
                if (response.length === 0){
                    document.querySelector('.find-student-notif h1').innerHTML = "Pelajar tidak ditemukan!";
                    document.querySelector('.dropdown-ls-student').innerHTML = "";                     
                    return;
                }
                document.querySelector('.find-student-notif h1').innerHTML = "";                
                document.querySelector('.dropdown-ls-student').innerHTML = "";           
                for(let user of response){
                    document.querySelector('.dropdown-ls-student').innerHTML += 
                        `<div onclick="autoFillInputStudent('${user.name}')" class='dropdown-ls-box h-2.5 w-auto bg-red-500'>
                        <p>${user.name}</p>
                    </div>`                        
                }

            },
            error : (error) => {
                console.error(error)
            }
        }
    );            
}

const autoFillInputStudent = (val) => {
    document.getElementById('ls-findstudent').value = val;
}

const ls_findBook = () => {
    const getInputValue = document.getElementById('ls-findbook').value;
    $.ajax(
        {
            url : "/findbook",
            type : "GET",
            data : {book : getInputValue},
            success : (response) => {                
                if (response.length === 0){
                    document.querySelector('.find-book-notif h1').innerHTML = "Buku tidak ditemukan!";
                    document.querySelector('.dropdown-ls-book').innerHTML = "";                         
                    return;
                }
                document.querySelector('.find-book-notif h1').innerHTML = "";                
                document.querySelector('.dropdown-ls-book').innerHTML = "";           
                for(let book of response){
                    document.querySelector('.dropdown-ls-book').innerHTML += 
                        `<div onclick="autoFillInputBook('${book.judul}')" class='dropdown-ls-box h-2.5 w-auto bg-red-500'>
                        <p>${book.judul}</p>
                    </div>`                        
                }
            },
            error : (error) => {
                console.error(error)
            }

        }
    );            
}

const autoFillInputBook = (val) => {
    document.getElementById('ls-findbook').value = val;
}