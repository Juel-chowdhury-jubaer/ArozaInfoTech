<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Use Of Counritesnode</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
   <div class="section">
       <h2>Country API-Javascript</h2>

    <div class="country-section" id="country-whole">
        <select name="country" id="country" class="country" onchange="javascript:handleSelect(this)">

        </select>
    </div>

    <div>
        <h2 id="country-info"></h2>
        <h3 id="currency"></h3>
        <h3 id="area"></h3>
    </div>

   </div>
    







<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript">
        var countryNames;

        fetch('https://countriesnode.herokuapp.com/v1/countries').then(function(info) {
            console.log(info);
            return info.json();
        }).then(function(data) {
            console.log(data);
            setData(data);
        }).catch(function(err) {
            console.log('Error : ' + err);
        });

        function setData(country) {

            countryNames = country;

            var url_string = window.location;
            var url = new URL(url_string);
            var pathname = url.pathname;
            var nameArray = pathname.split('/');
            var countryCode = nameArray[nameArray.length - 1];
            //alert(countryCode);
            if (countryCode == 'country' || countryCode == 'country.php' ) {

                document.getElementById('country-whole').setAttribute('style','display:block');
                var options = "";
                var suboptions = "";
                for (i = 0; i < countryNames.length; i++) {

                    Name = countryNames[i].name;
                    language = countryNames[i].languages;
                    code = countryNames[i].code;
                    //alert(Name);

                    $.ajax({
                        'url': 'action.php',
                        'type': 'POST',
                        'data': {
                            'name': Name,
                            'language': language,
                            'code': code
                        },
                        'success': function(data) {
                            //alert(data);
                        }
                    });

                    options += '<option value=' + countryNames[i].code + '>' + countryNames[i].name + ' | Language : ' + countryNames[i].languages+' | Native : '+ countryNames[i].native+ '</option>';

                    document.getElementById('country').innerHTML = options;




                }

            }


            if (countryCode != 'country' && countryCode != 'country.php') {
                //alert(countryCode);
                document.getElementById('country-whole').setAttribute('style','display:none');
                for (i = 0; i < countryNames.length; i++) {
                    if (countryNames[i].code == countryCode) {
                        //alert(countryNames[i].currency);
                        document.getElementById('country-info').innerHTML = 'You Select -' + countryNames[i].name;
                        document.getElementById('currency').innerHTML = 'Currency :' + countryNames[i].currency;
                        document.getElementById('area').innerHTML = 'Area Code (Phone) :' + countryNames[i].phone;
                    }
                }
            }

        }

        $.ajax({
            'url': 'action.php',
            'type': 'POST',
            'data': {
                'name': 'I love You',
            },
            'success': function(data) {
                //alert(data);
            }
        });

    </script>
    <div>
        <script type="text/javascript">
            var url_string = window.location;
            var url = new URL(url_string);
            var pathname = url.pathname;
            var nameArray = pathname.split('/');
            var countryCode = nameArray[nameArray.length - 1];
            //alert(countryNames);
            //        for (i = 0; i < countryNames.length; i++){
            //            
            //        }

        </script>
    </div>



    <script type="text/javascript">
        function handleSelect(elm) {
            window.location = 'country/' + elm.value;
        }

    </script>
</body>

</html>
