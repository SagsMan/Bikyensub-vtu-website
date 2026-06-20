<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Number verification with OTP</title>
<style>
  .container {
    width: 302px;
    height: 175px;
    position: absolute;
    left: 0px;
    right: 0px;
    top: 0px;
    bottom: 0px;
    margin: auto;
  }
  #number, #verificationcode {
    width: calc(100% - 24px);
    padding: 10px;
    font-size: 20px;
    margin-bottom: 5px;
    outline: none;
  }
  #recaptcha-container {
    margin-bottom: 5px;
  }
  #send, #verify {
    width: 100%;
    height: 40px;
    outline: none;
  }
  .p-conf, .n-conf {
    width: calc(100% - 22px);
    border: 2px solid green;
    border-radius: 4px;
    padding: 8px 10px;
    margin: 4px 0px;
    background-color: rgba(0, 249, 12, 0.5);
    display: none;
  }
  .n-conf {
    border-color: red;
    background-color: rgba(255, 0, 4, 0.5);
  }
</style>
</head>

<body>
  <div class="container">
    <div id="sender">
      <input type="text" id="number" placeholder="+923...">
      <div id="recaptcha-container"></div>
      <input type="button" id="send" value="Send" onClick="phoneAuth()">
      <input type="button" id="pay" value="Pay" onClick="pay()">
    </div>
    <div id="verifier" style="display: none">
      <input type="text" id="verificationcode" placeholder="OTP Code">
      <input type="button" id="verify" value="Verify" onClick="codeverify()">
      <div class="p-conf">Number Verified</div>
      <div class="n-conf">OTP ERROR</div>
    </div>
  </div>
<!--  add firebase SDK-->
<script src="https://www.gstatic.com/firebasejs/9.12.1/firebase-app-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.12.1/firebase-auth-compat.js"></script>
<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
  
// Your web app's Firebase configuration

// For Firebase JS SDK v7.20.0 and later, measurementId is optional

const firebaseConfig = {
  apiKey: "AIzaSyAFyYUyI5KFFVPS24C0pU1MxLVWvVPGnDo",
  authDomain: "otps-ecfd6.firebaseapp.com",
  projectId: "otps-ecfd6",
  storageBucket: "otps-ecfd6.appspot.com",
  messagingSenderId: "492626400858",
  appId: "1:492626400858:web:bf7c036e8b5fdaf4ff2a63",
  measurementId: "G-QK00CNGN94"
};


// Initialize Firebase
firebase.initializeApp(firebaseConfig);

//const app = initializeApp(firebaseConfig);
//const analytics = getAnalytics(app);





render();




function render(){
  window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
  recaptchaVerifier.render();
}
  // function for send message
function phoneAuth(){
  var number = document.getElementById('number').value;
  firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function(confirmationResult){
    window.confirmationResult = confirmationResult;
    coderesult = confirmationResult;
    document.getElementById('sender').style.display = 'none';
    document.getElementById('verifier').style.display = 'block';
  }).catch(function(error){
    alert(error.message);
  });
}
  // function for code verify
function codeverify(){
  var code = document.getElementById('verificationcode').value;
  coderesult.confirm(code).then(function(){
    document.getElementsByClassName('p-conf')[0].style.display = 'block';
    document.getElementsByClassName('n-conf')[0].style.display = 'none';
  }).catch(function(){
    document.getElementsByClassName('p-conf')[0].style.display = 'none';
    document.getElementsByClassName('n-conf')[0].style.display = 'block';
  })
}


  // function for code verify

function pay(){
      // Make an AJAX request to get the API key from a PHP file
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "_get_api_key.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Parse the API key from the response
            var apiKey = xhr.responseText.trim();
            console.log(apiKey)
            // Use the retrieved API key in the Paystack setup
            let handler = PaystackPop.setup({
                key: apiKey, // Use the retrieved API key
                email: 'u@u.com',// document.getElementById("email-address").value,
                amount: '300',// document.getElementById("amount").value * 100,
                ref: ''+Math.floor((Math.random() * 1000000000) + 1),
                onClose: function(){
                    alert('Window closed.');
                },
                callback: function(response){
                    let message = 'Payment complete! Reference: ' + response.reference;
                    alert(message);
                }
            });

            // Open the Paystack payment iframe
            handler.openIframe();
        }
    };
    xhr.send();
}
</script>



<!--script type="text/javascript">
  const paymentForm = document.getElementById('paymentForm');

paymentForm.addEventListener("submit", function(e) {
    e.preventDefault();

    // Make an AJAX request to get the API key from a PHP file
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "_get_api_key.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Parse the API key from the response
            var apiKey = xhr.responseText.trim();

            // Use the retrieved API key in the Paystack setup
            let handler = PaystackPop.setup({
                key: apiKey, // Use the retrieved API key
                email: document.getElementById("email-address").value,
                amount: document.getElementById("amount").value * 100,
                ref: ''+Math.floor((Math.random() * 1000000000) + 1),
                onClose: function(){
                    alert('Window closed.');
                },
                callback: function(response){
                    let message = 'Payment complete! Reference: ' + response.reference;
                    alert(message);
                }
            });

            // Open the Paystack payment iframe
            handler.openIframe();
        }
    };
    xhr.send();
}, false);

</script-->
</body>
</html>
