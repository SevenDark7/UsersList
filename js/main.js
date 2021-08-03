//////////// Display Time In Header //////////// 

setInterval(function() {
  var currentTime = new Date();
  var secounds = currentTime.getSeconds();
  var minutes = currentTime.getMinutes();
  var hours = currentTime.getHours();

  secounds = (secounds < 10 ? "0" : "") + secounds;
  minutes = (minutes < 10 ? "0" : "") + minutes;
  hours = (hours < 10 ? "0" : "") + hours;

  var fullTime = hours + " : " + minutes + " : " + secounds;
  $(".time").text(fullTime);
  
}, 1000);


//////////// Button Events ////////////

document.getElementById('change').hidden = true;
document.querySelector('#register').addEventListener('click', function() {
  let username = document.getElementById('userName').value;
  let userage = document.getElementById('userAge').value;
  let usercity = document.getElementById('userCity').value;
  if (username.trim().length < 1 || parseInt(userage) < 1 || usercity.trim().length < 1) {
    alert("لطفا مقادیر مربوطه را به صورت صحیح وارد کنید");
  }else {
    //////////// Create Row For New User ////////////
    var row = document.createElement('tr');
    document.querySelector('.users').prepend(row);

    //////////// Create Button For Delete User ////////////
    var dltCell = document.createElement('td');
    row.appendChild(dltCell);
    var dltBtn = document.createElement('button');
    dltBtn.type = 'button';
    dltBtn.className = 'del';
    dltBtn.innerHTML = 'حذف';
    dltCell.appendChild(dltBtn);

    //////////// Create Button For Edit User ////////////
    var edtCell = document.createElement('td');
    row.appendChild(edtCell);
    var edtBtn = document.createElement('button');
    edtBtn.type = 'button';
    edtBtn.className = 'edit';
    edtBtn.innerHTML = 'ویرایش';
    edtCell.appendChild(edtBtn);

    //////////// Create Cell For User City ////////////
    var cityCell = document.createElement('td');
    cityCell.innerHTML = usercity;
    row.appendChild(cityCell);

    //////////// Create Cell For User Age ////////////
    var ageCell = document.createElement('td');
    ageCell.innerHTML = userage;
    row.appendChild(ageCell);

    //////////// Create Cell For User Name ////////////
    var nameCell = document.createElement('td');
    nameCell.innerHTML = username;
    row.appendChild(nameCell);

    //////////// Clear Form Inputs ////////////
    document.getElementById('reset').click();
  }
});

//////////// Create Delete Button Event ////////////
$(document).on('click', '.del', function() {
  $(this).parents('tr').remove();
});

//////////// Create Edit Button Event ////////////
let childs;
let usercity;
let userage;
let username;

$(document).on('click', '.edit', function() {
  document.getElementById('register').hidden = true;
  document.getElementById('change').hidden = false;
  childs = $(this).parents('tr');
  usercity = childs.children("td:nth-child(3)");
  userage = childs.children("td:nth-child(4)");
  username = childs.children("td:nth-child(5)");
  document.getElementById('reset').click();
  document.getElementById('userName').value = username.text();
  document.getElementById('userAge').value = userage.text();
  document.getElementById('userCity').value = usercity.text();
});

//////////// Create Change Button Event ////////////
document.getElementById('change').addEventListener('click', function() {
  city = document.getElementById('userCity').value;
  age = document.getElementById('userAge').value;
  name = document.getElementById('userName').value;
  if (city.trim().length < 1 || parseInt(age) < 1 || name.trim().length < 1) {
    alert("لطفا مقادیر مربوطه را به صورت صحیح وارد کنید");
  } else {
    usercity.text(city)
    userage.text(age);
    username.text(name);
    document.getElementById('reset').click();
    document.getElementById('change').hidden = true;
    document.getElementById('register').hidden = false;
  }
});



//////////// JQuery Codes ////////////

// $(document).ready(function() {
//     $("#change").hide();
//     $("#register").click(function() {
//       var username = $("#userName").val();
//       var userage = $("#userAge").val();
//       var usercity = $("#userCity").val();
//       if (username.trim().length < 1 || userage.trim().length < 1 || parseInt(userage) < 1 || usercity.trim().length < 1) {
//         alert("لطفا مقادیر مربوطه را به صورت صحیح وارد کنید");
//       }else {
//         var userRow = $("<tr></tr>").prependTo(".users");
//         var deleteData = $("<td></td>").appendTo(userRow);
//         $("<button></button>").addClass("del").attr("type", "button").text("حذف").appendTo(deleteData);
//         var editData = $("<td></td>").appendTo(userRow);
//         $("<button></button>").addClass("edit").attr("type", "button").text("ویرایش").appendTo(editData);
//         $("<td></td>").text(usercity).appendTo(userRow);
//         $("<td></td>").text(userage).appendTo(userRow);
//         $("<td></td>").text(username).appendTo(userRow);
//         $("#reset").click();
//       }
//     });

//     $(document).on('click', '.del', function() {
//       $(this).parents('tr').remove();
//     });

//     let editRow;
//     let usercity;
//     let userage;
//     let username;

//     $(document).on('click', '.edit', function() {
//       $("#register").hide();
//       $("#change").show();
//       editRow = $(this).parent().parent();
//       usercity = editRow.children("td:nth-child(3)");
//       userage = editRow.children("td:nth-child(4)");
//       username = editRow.children("td:nth-child(5)");
//       $("#reset").click();
//       $("#userName").val(username.text());
//       $("#userAge").val(userage.text());
//       $("#userCity").val(usercity.text());
//     });
    
//     $("#change").click(function() {
//       if ($("#userCity").val().trim().length < 1 || $("#userAge").val().trim().length < 1 || parseInt($("#userAge").val()) < 1 || $("#userName").val().trim().length < 1) {
//         alert("لطفا مقادیر مربوطه را به صورت صحیح وارد کنید");
//       }else {
//         usercity.text($("#userCity").val());
//         userage.text($("#userAge").val());
//         username.text($("#userName").val());
//         $("#reset").click();
//         $("#change").hide();
//         $("#register").show();
//       }
//     });

//   });

