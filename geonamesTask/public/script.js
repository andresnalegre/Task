$(document).ready(function() {
    $(window).on('load', function() {
        if ($('#preloader').length) {
            $('#preloader').delay(1000).fadeOut('slow', function() {
                $(this).remove();
            });
        }
    });

    $('#getInfo').on('click', function() {
        var country = $('#country').val();
        $('#loading').show();
        $('#result').html('');

        $.ajax({
            url: '../src/getCountryInfo.php',
            type: 'GET',
            dataType: 'json',
            data: { country: country },
            success: function(result) {
                $('#loading').hide();
                if (result.status === 'ok') {
                    var data = result.data;
                    var info = `
                        <h2>${data.countryName}</h2>
                        <p><strong>Continent:</strong> ${data.continent}</p>
                        <p><strong>Capital:</strong> ${data.capital}</p>
                        <p><strong>Languages:</strong> ${data.languages}</p>
                        <p><strong>Geoname ID:</strong> ${data.geonameId}</p>
                        <p><strong>South:</strong> ${data.south}</p>
                        <p><strong>ISO Alpha-3:</strong> ${data.isoAlpha3}</p>
                        <p><strong>North:</strong> ${data.north}</p>
                        <p><strong>FIPS Code:</strong> ${data.fipsCode}</p>
                        <p><strong>Population:</strong> ${data.population}</p>
                        <p><strong>East:</strong> ${data.east}</p>
                        <p><strong>ISO Numeric:</strong> ${data.isoNumeric}</p>
                        <p><strong>Area (sq km):</strong> ${data.areaInSqKm}</p>
                        <p><strong>Country Code:</strong> ${data.countryCode}</p>
                        <p><strong>West:</strong> ${data.west}</p>
                        <p><strong>Postal Code Format:</strong> ${data.postalCodeFormat}</p>
                        <p><strong>Continent Name:</strong> ${data.continentName}</p>
                        <p><strong>Currency Code:</strong> ${data.currencyCode}</p>
                    `;
                    $('#result').html(info);
                } else {
                    $('#result').html('Error retrieving information.');
                }
            },
            error: function() {
                $('#loading').hide();
                $('#result').html('Request error. Please try again later.');
            }
        });
    });

    $('#getCityInfo').on('click', function() {
        var city = $('#city').val();
        $('#loading').show();
        $('#result').html('');

        var coordinates = {
            'BA': { lat: -34.6037, lng: -58.3816 },
            'SP': { lat: -23.5505, lng: -46.6333 },
            'DU': { lat: 53.3498, lng: -6.2603 },
            'NY': { lat: 40.7128, lng: -74.0060 },
            'LD': { lat: 51.5074, lng: -0.1278 }
        };

        var lat = coordinates[city].lat;
        var lng = coordinates[city].lng;

        $.ajax({
            url: '../src/getNearbyWikipedia.php',
            type: 'GET',
            dataType: 'json',
            data: { lat: lat, lng: lng },
            success: function(result) {
                $('#loading').hide();
                if (result.status === 'ok') {
                    var articles = result.data.map(article => `<p>${article.title}: ${article.summary}</p>`).join('');
                    $('#result').html(articles);
                } else {
                    $('#result').html('Error retrieving Wikipedia information.');
                }
            },
            error: function() {
                $('#loading').hide();
                $('#result').html('Request error. Please try again later.');
            }
        });
    });

    $('#getLanguageInfo').on('click', function() {
        var language = $('#language').val();
        $('#loading').show();
        $('#result').html('');

        var coordinates = {
            'EN': { lat: 51.5074, lng: -0.1278 },
            'ES': { lat: 40.4168, lng: -3.7038 },
            'PT': { lat: -23.5505, lng: -46.6333 },
            'FR': { lat: 48.8566, lng: 2.3522 },
            'DE': { lat: 52.5200, lng: 13.4050 }
        };

        var lat = coordinates[language].lat;
        var lng = coordinates[language].lng;

        $.ajax({
            url: '../src/getTimezoneInfo.php',
            type: 'GET',
            dataType: 'json',
            data: { lat: lat, lng: lng },
            success: function(result) {
                $('#loading').hide();
                if (result.status === 'ok') {
                    var data = result.data;
                    var timezoneInfo = `
                        <p><strong>Timezone ID:</strong> ${data.timezoneId}</p>
                        <p><strong>GMT Offset:</strong> ${data.gmtOffset}</p>
                        <p><strong>DST Offset:</strong> ${data.dstOffset}</p>
                        <p><strong>Country Name:</strong> ${data.countryName}</p>
                    `;
                    $('#result').html(timezoneInfo);
                } else {
                    $('#result').html('Error retrieving timezone information.');
                }
            },
            error: function() {
                $('#loading').hide();
                $('#result').html('Request error. Please try again later.');
            }
        });
    });
});