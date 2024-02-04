window.addEventListener('load', function () {
    rangoAreasTotal();
}, false);


function rangoAreasTotal() {
    if (document.querySelector('#reporteArea')) {
        const ajaxUrl = base_url + '/Areas/getSelectAreas';
        const request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET", ajaxUrl, true);
        request.send();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                document.querySelector('#reporteArea').innerHTML = request.responseText;
                $('#reporteArea').selectpicker('render');
            }
        }
    }

}
