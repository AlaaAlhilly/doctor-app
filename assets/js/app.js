$(document).ready(function(){
$("#dtBox").DateTimePicker();

var path = window.location.pathname;
var page = path.split("/").pop();
if(page === "patient-search.php"){
    page = "patients-details.php";
}
var header = document.getElementById("list-tab");
var btns = header.getElementsByClassName("list-group-item-action");
for (var i = 0; i < btns.length; i++) {
    var current = document.getElementsByClassName("active");
    current.className = current.className = "list-group-item list-group-item-action";
    if(page === btns[i].getAttribute('href')){
        btns[i].setAttribute('class','list-group-item list-group-item-action active');
        break;
    }
    
}
// var date;
// var time;
$('#date').change(function(){
    var t = moment($('#date').val().trim(),"DD/MM/YYYY HH:mm");
    var date =t.format("YYYY-MM-DD");
    
    $(this).val(date);
    $('#docdate').val(date.toString());
    if(date != "Invalid date"){
        if (date == null) {
            return;
        }
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("time_av").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "charge.php?q="+date, true);
        xhttp.send();
    }
    $(this).attr('disabled','disabled');
    $('#reset').show();
    $('#doctor').empty();
    setTimeout(function(){
        var xhttp2 = new XMLHttpRequest();
        xhttp2.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                $("#doctor").val(this.responseText);
                document.getElementById("doc").innerHTML = this.responseText;
                $('#doctime').val(document.getElementById("time_av").options[0].text);
            }
        };
        xhttp2.open("GET", "charge.php?q=first", true);
        xhttp2.send();
    },2000);
    setTimeout(function(){

    },1000);

        
});
$('#time_av').change(function(){
    $('#doctor').empty();
    var time = $('#time_av option:selected').val().trim();
    $('#doctime').val($('#time_av').find("option:selected").val());
    console.log($('#doctime').val());
    if(time != "Invalid date"){
        var xhttp; 
        if (time == null) {
            return;
        }
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("doc").innerHTML = this.responseText;
                var dr = this.responseText;
                $("#doctor").val(dr);
            }
        };
        xhttp.open("GET", "charge.php?q="+time, true);
        xhttp.send();
    }
});
$('#reset').click(function(){
    $('#date').val('');
    $('#date').removeAttr('disabled');
    $('#time_av').html('');
    $('#reset').hide();
    }); 
    //payment script
// Create a Stripe client.
var stripe = Stripe('');

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
});
