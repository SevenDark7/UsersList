$(document).ready(function () {
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

    $('#default').click(function () {
      var url = 'def.php';
      $.ajax(url, {
        url: url,
        type: 'POST',
        dataType: 'json',
        success: function (data) {
          $('tbody tr').remove();
          data.forEach(function(item) {
            $('tbody').append('<tr>' + '<td>' + "<a href=index.php?line=" + item[0] +"><button type='button' class='del'>حذف</button></a>" + '</td>' +
            '<td>' + "<a href=index.php?line=" + item[0]/*"e*/+"><button type='button' class='edit'>ویرایش</button></a>" + '</td>' +
            '<td>' + item[3] + '</td>' + 
            '<td>' + item[2] + '</td>' + 
            '<td>' + item[1] + '</td>' + '</tr>');
          });
        },
        error: function() {
          alert('Error loading information');
        },
      });
    });

    $(document).on('click', '#register', function(e) {
      e.preventDefault();
      $.ajax('reg.php', {
        url: 'reg.php',
        type: "POST",
        data: {"userName":$('#userName').val(), "userAge":$('#userAge').val(), "userCity":$('#userCity').val()},
        dataType: "json",
        success: function (data) {
          $('tbody tr').remove();
          data.forEach(function(item, index) {
            $('tbody').append('<tr>' + '<td>' + "<a href=index.php?line=" + item[0] +"><button type='button' class='del'>حذف</button></a>" + '</td>' +
            '<td>' + "<a href=index.php?line=" + item[0]/*"e*/+"><button type='button' class='edit'>ویرایش</button></a>" + '</td>' +
            '<td>' + item[3] + '</td>' + 
            '<td>' + item[2] + '</td>' + 
            '<td>' + item[1] + '</td>' + '</tr>');
          });
          $("#userName").val('');
          $("#userAge").val('');
          $("#userCity").val('');
          $("#userName").focus();
        },
        error: function() {
          alert('Error registering user');
        },
      });
    });

    $(document).on('click', '.del', function(e) {
      e.preventDefault();
      var row = $(this).parent().attr('href');
      row = row.split('=');
      var user = {'row':row[1]};
      $.ajax({
        url: 'dlt.php',
        type: 'POST',
        data: user,
        dataType: 'json',
        success: function(data) {
          $('tbody tr').remove();
          data.forEach(function(item) {
            $('tbody').append('<tr>' + '<td>' + "<a href=index.php?line=" + item[0] +"><button type='button' class='del'>حذف</button></a>" + '</td>' +
            '<td>' + "<a href=index.php?line=" + item[0]/*"e*/+"><button type='button' class='edit'>ویرایش</button></a>" + '</td>' +
            '<td>' + item[3] + '</td>' + 
            '<td>' + item[2] + '</td>' + 
            '<td>' + item[1] + '</td>' + '</tr>');
          });
        },
        error: function() {
          alert('Error loading users');
        },
      });
    });

    let id;

    $(document).on('click', '.edit', function(e) {
      e.preventDefault();
      var row = $(this).parent().attr('href');
      row = row.split('=');
      id = row[1];
      $("#register").attr('id', 'change');
      var editRow = $(this).parents('tr');
      usercity = editRow.children("td:nth-child(3)").text();
      userage = editRow.children("td:nth-child(4)").text();
      username = editRow.children("td:nth-child(5)").text();
      $("#userName").val('');
      $("#userAge").val('');
      $("#userCity").val('');
      $("#userName").focus();
      $("#userName").val(username);
      $("#userAge").val(userage);
      $("#userCity").val(usercity);
      $("#userName").focus();
    });

    $(document).on('click', '#change', function(e) {
      e.preventDefault();
      if ($("#userCity").val().trim().length < 1 || $("#userAge").val().trim().length < 1 || parseInt($("#userAge").val()) < 1 || $("#userName").val().trim().length < 1) {
        alert("لطفا مقادیر مربوطه را به صورت صحیح وارد کنید");
      }
      else {
        var usercity = $("#userCity").val();
        var userage = $("#userAge").val();
        var username = $("#userName").val();
        $.ajax({
          url: 'edt.php',
          type: 'POST',
          data: {'id':id, 'name':username, 'age':userage, 'city':usercity},
          dataType: 'json',
          success: function(data) {
            $('tbody tr').remove();
            $("#userName").val('');
            $("#userAge").val('');
            $("#userCity").val('');
            $("#userName").focus();
            $("#change").attr('id', 'register');
            $("#userName").focus();
            data.forEach(function(item) {
              $('tbody').append('<tr>' + '<td>' + "<a href=index.php?line=" + item[0] +"><button type='button' class='del'>حذف</button></a>" + '</td>' +
              '<td>' + "<a href=index.php?line=" + item[0]/*"e*/+"><button type='button' class='edit'>ویرایش</button></a>" + '</td>' +
              '<td>' + item[3] + '</td>' + 
              '<td>' + item[2] + '</td>' + 
              '<td>' + item[1] + '</td>' + '</tr>');
            });
          },
          error: function() {
            alert('Error edit user');
          },
        });
      }
    });

    $(document).on('click', '#reset', function(e) {
        $("#change").attr('id', 'register');
    });
  });