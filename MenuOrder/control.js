let selectedMenuId = null;
let basket = JSON.parse(localStorage.getItem("data")) || [];

function showForm(menubox) {
    if (selectedMenuId !== null) {
        return; // ป้องกันการกดเลือกเมนูอื่น
    }
    const menuId = menubox.dataset.menuId;
    const menuName = menubox.dataset.menuName;
    const menuDescription = menubox.dataset.menuDescription;
    const menuImage = menubox.dataset.menuImage;
    document.getElementById("menu-id").textContent = menuId;
    document.getElementById("menu-image").src = "img/menu/" + menuImage;
    document.getElementById("menu-name").textContent = menuName;
    document.getElementById("menu-description").textContent = menuDescription;
    document.getElementById("myForm").style.display = "block";
    selectedMenuId = menuId;

    document.body.classList.toggle("menu-selected", true);

}

function closeForm() {
    document.getElementById("myForm").style.display = "none";
    selectedMenuId = null;
    resetForm();

    document.body.classList.remove("menu-selected");
}

function plusamount() {
    const amountElement = document.getElementById("amount");
    let amount = parseInt(amountElement.textContent);
    amount++;
    amountElement.textContent = amount.toString();
}

function minamount() {
    const amountElement = document.getElementById("amount");
    let amount = parseInt(amountElement.textContent);
    if (amount > 1) {
        amount--;
        amountElement.textContent = amount.toString();
    }
}

function resetForm() {
    const amountElement = document.getElementById("amount");
    amountElement.textContent = "1";
}

function order() {
    let menuId = parseInt(document.getElementById("menu-id").textContent);
    let menuName = document.getElementById("menu-name").textContent;
    let amount = parseInt(document.getElementById("amount").textContent);
    document.getElementById("myForm").style.display = "none";
    selectedMenuId = null;
    resetForm();
    document.body.classList.remove("menu-selected");

    let search = basket.find((x) => x.id === menuId);
    if (search === undefined) {
        basket.push({
            id: menuId,
            name: menuName,
            amount: amount
        });
    } else {
        search.amount += amount;
    }
    localStorage.setItem("data", JSON.stringify(basket));
}


function showBasket(){
    document.getElementById("basketform").style.display = "block";
    generatecartitems();

}

function closeBasketForm() {
    document.getElementById("basketform").style.display = "none";
}


function generatecartitems(){
    if(basket.length != 0){
        document.getElementById("basketLabel").innerHTML = basket.map((x) => {
            return `<div class="cart-item">
            <h1>${x.name}</h1>
            <i class="fa-solid fa-minus" onclick="decrease(${x.id})"></i>
            <label id="${x.id}">${x.amount}</label>
            <i class="fa-solid fa-plus" onclick="increase(${x.id})"></i>
            
            <i class="fa-solid fa-trash" onclick="removeitem(${x.id})"></i>
        </div>`;
        }).join("");
        document.getElementById("basketbutton").style.display = "block";
        return;
    }
    else{
        document.getElementById("basketLabel").innerHTML = `<h1 class='empty-basket'>ตะกร้าสินค้าว่างเปล่า</h1>`;
        document.getElementById("basketbutton").style.display = "none";
    }
    document.getElementById("basketLabel").innerHTML = `<h1 class='empty-basket'>ตะกร้าสินค้าว่างเปล่า</h1>`;
    document.getElementById("basketbutton").style.display = "none";
}

function increase(x) {
    let id = parseInt(x);
    let num = parseInt(document.getElementById(id).textContent);
    num++;
    document.getElementById(id).innerHTML = num;

    let search = basket.find((y) => y.id === id);
    if (search !== undefined) {
        search.amount = num;
        localStorage.setItem("data", JSON.stringify(basket));
    }
}

function decrease(x) {
    let id = parseInt(x);
    if (isNaN(id)) {
        console.error("Invalid ID:", x.id);
        return;
    }
    
    let element = document.getElementById(id);
    if (element) {
        let num = parseInt(element.textContent);
        num--;
        element.innerHTML = num;

        if (num === 0) {
            removeitem(x);
        } else {
            let search = basket.find((y) => y.id === id);
            if (search !== undefined) {
                search.amount = num;
                localStorage.setItem("data", JSON.stringify(basket));
            }
        }
    } else {
        console.error("Element not found for id:", id);
    }
}

function removeitem(x) {
    let id = parseInt(x);
    basket = basket.filter((y) => y.id !== id);
    localStorage.setItem("data", JSON.stringify(basket));
    generatecartitems();
}

function confirm(number) {
    var xhr = new XMLHttpRequest();

    // กำหนด method และ URL ที่ต้องการส่งข้อมูลไป
    xhr.open('POST', 'confirm_order.php', true);

    // กำหนด header สำหรับการส่งข้อมูลแบบ JSON
    xhr.setRequestHeader('Content-Type', 'application/json');

    // กำหนด callback function สำหรับการตอบรับ
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // ตอบรับสำเร็จ
            console.log(xhr.responseText);
        }
    };

    var dataToSend = {
        tableNumber: number,
        orderData: localStorage.getItem('data')
    };

    xhr.send(JSON.stringify(dataToSend));

    // Show the overlay
    document.getElementById("overlay").style.display = "flex";

    // Hide the overlay
    


    // Hide the overlay after 2 seconds
    setTimeout(function() {
        document.getElementById("overlay").style.display = "none";
    }, 2000);

    basket = [];
    localStorage.clear();
    closeBasketForm();
}
