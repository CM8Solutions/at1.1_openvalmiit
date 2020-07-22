function Tallenna() {
    var nimi = document.getElementById("nimi").value;

 

    if(nimi === ''){
        document.getElementById("nimi").style.backgroundColor = "yellow";
     
        document.getElementById("tyhja").innerHTML = 'Nimi-kenttä on täytettävä!';
           document.getElementById("tyhja").style.color = "red";
        
        return false;
    }
    else{
                
           alert("Lomake on tallennettu!\nLähetetty nimi on " + nimi);
return true;
    }
    
}
