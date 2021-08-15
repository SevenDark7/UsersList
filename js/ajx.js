////////////////// Set Time In Header //////////////////

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

////////////////// Return To Default Users Event //////////////////

    $('#default').click(function () {
      var url = 'ajx.php';
      $.ajax(url, {
        url: url,
        type: 'POST',
        data: {'action' : 1},
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
          $('.panel').toggle('slide');
          setTimeout(function() {
            if ($('.panel').attr('display') != 'none') {
              $('.panel').toggle('slide');
            }
          }, 2000);
          $('#subject').text('Default Users Loaded');
          $('#text').text('لیست کاربران پیشفرض با موفقیت بارگیری شد');
        },
        error: function() {
          $('.panel').toggle('slide');
          setTimeout(function() {
            if ($('.panel').attr('display') != 'none') {
              $('.panel').toggle('slide');
            }
          }, 2000);
          $('#subject').text('Error Loading');
          $('#text').text('خطا در بارگیری لیست کاربران پیشفرض');
        },
      });
    });

////////////////// Register A New User Event //////////////////

    $(document).on('click', '#register', function(e) {
      e.preventDefault();
      $.ajax('ajx.php', {
        url: 'ajx.php',
        type: "POST",
        data: {'action' : 2, "userName":$('#userName').val(), "userAge":$('#userAge').val(), "userCity":$('#userCity').val()},
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

          $('.panel').toggle('slide');
          setTimeout(function() {
            if ($('.panel').attr('display') != 'none') {
              $('.panel').toggle('slide');
            }
          }, 2000);
          $('#subject').text('Register User Successfuly');
          $('#text').text('کاربر جدید با موفقیت ثبت شد');
        },
        error: function() {
          $('.panel').toggle('slide');
          setTimeout(function() {
            if ($('.panel').attr('display') != 'none') {
              $('.panel').toggle('slide');
            }
          }, 2000);
          $('#subject').text('Error Registration');
          $('#text').text('خطا در ثبت کاربر جدید');
        },
      });
    });

////////////////// Delete User Event //////////////////

    $(document).on('click', '.del', function(e) {
      e.preventDefault();
      var row = $(this).parent().attr('href');
      row = row.split('=');
      var user = {'action' : 3, 'row':row[1]};
      $.ajax({
        url: 'ajx.php',
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
          $('.panel').toggle('slide');
          setTimeout(function() {
            if ($('.panel').attr('display') != 'none') {
              $('.panel').toggle('slide');
            }
          }, 2000);
          $('#subject').text('Delete User Successfuly');
          $('#text').text('کاربر منتخب با موفقیت حذف شد');
        },
        error: function() {
          $('.panel').toggle('slide');
          setTimeout(function() {
            if ($('.panel').attr('display') != 'none') {
              $('.panel').toggle('slide');
            }
          }, 2000);
          $('#subject').text('Error Delete User');
          $('#text').text('خطا در حذف کاربر');
        },
      });
    });

////////////////// Edit User Event //////////////////

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
          url: 'ajx.php',
          type: 'POST',
          data: {'action' : 4, 'id':id, 'name':username, 'age':userage, 'city':usercity},
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
            $('.panel').toggle('slide');
            setTimeout(function() {
              if ($('.panel').attr('display') != 'none') {
                $('.panel').toggle('slide');
              }
            }, 2000);
            $('#subject').text('Edit User Successfuly');
            $('#text').text('ویرایش کاربر با موفقیت انجام شد');
          },
          error: function() {
            $('.panel').toggle('slide');
            setTimeout(function() {
              if ($('.panel').attr('display') != 'none') {
                $('.panel').toggle('slide');
              }
            }, 2000);
            $('#subject').text('Error Edit User');
            $('#text').text('خطا در ویرایش کاربر');
          },
        });
      }
    });

////////////////// Reset Button Event //////////////////

    $(document).on('click', '#reset', function() {
        $("#change").attr('id', 'register');
    });
  });