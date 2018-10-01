function JoursFeries(an){
    var joursFeries = [];
    for ( var i=0; i<= 2;i++) {
        var JourAn = new Date(Date.UTC(an+i, "00", "01"));
        var FeteTravail = new Date(Date.UTC(an+i, "04", "01"));
        var Victoire1945 = new Date(Date.UTC(an+i, "04", "08"));
        var FeteNationale = new Date(Date.UTC(an+i,"06", "14"));
        var Assomption = new Date(Date.UTC(an+i, "07", "15"));
        var Toussaint = new Date(Date.UTC(an+i, "10", "01"));
        var Armistice = new Date(Date.UTC(an+i, "10", "11"));
        var Noel = new Date(Date.UTC(an+i, "11", "25"));

        var G = (an+i)%19;
        var C = Math.floor((an+i)/100);
        var H = (C - Math.floor(C/4) - Math.floor((8*C+13)/25) + 19*G + 15)%30;
        var I = H - Math.floor(H/28)*(1 - Math.floor(H/28)*Math.floor(29/(H + 1))*Math.floor((21 - G)/11));
        var J = ((an+i)*1 + Math.floor((an+i)/4) + I + 2 - C + Math.floor(C/4))%7;
        var L = I - J;
        var MoisPaques = 3 + Math.floor((L + 40)/44);
        var JourPaques = L + 28 - 31*Math.floor(MoisPaques/4);
        var LundiPaques = new Date(Date.UTC(an+i, MoisPaques-1, JourPaques+1));
        var JeudiAscension = new Date(Date.UTC(an+i, MoisPaques-1, JourPaques+39));
        var LundiPentecote = new Date(Date.UTC(an+i, MoisPaques-1, JourPaques+50));

        joursFeries.push(JourAn, LundiPaques, FeteTravail, Victoire1945, JeudiAscension, LundiPentecote, FeteNationale, Assomption, Toussaint, Armistice, Noel);
    }
    return joursFeries;
}

function ClosingDays(an) {
    var closingDays = [];
    for (var j = 0; j <= 2; j++) {
        var FeteTravail = new Date(Date.UTC(an + j, "04", "01"));
        var Toussaint = new Date(Date.UTC(an + j, "10", "01"));
        var Noel = new Date(Date.UTC(an + j, "11", "25"));

        closingDays.push(FeteTravail, Toussaint, Noel);
    }
    return closingDays;
}

function Highlight(date) {
    var calender_date = date.getFullYear() + '-' + ('0' + (date.getMonth() + 1)).slice(-2) + '-' + ('0' + date.getDate()).slice(-2);
    if (~holiday.indexOf(calender_date)) {
        return {
            classes: 'highlighted',
            tooltip: 'La Billetterie en ligne est fermée les dimanches et jours fériés. Réservation possible uniquement au guichet du musée.'
        }
    }
}

var today       = new Date();
var an          = today.getFullYear();
var holiday     = JoursFeries(an);
var closingDays = ClosingDays(an);

for (var i = 0; i < holiday.length; i++) {
    holiday[i] = JSON.stringify(holiday[i]);
    holiday[i] = holiday[i].substring(1,11);
}

for (var j = 0; j < closingDays.length; j++) {
    closingDays[j] = JSON.stringify(closingDays[j]);
    closingDays[j] = closingDays[j].substring(1,11);
    closingDays[j] = closingDays[j].substring(8,10) + '-'+ closingDays[j].substring(5,7) + '-' + closingDays[j].substring(0,4);
}

$.fn.datepicker.dates['fr'] = {
    days: ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"],
    daysShort: ["Dim.", "Lun.", "Mar.", "Mer.", "Jeu.", "Ven.", "Sam."],
    daysMin: ["d", "l", "ma", "me", "j", "v", "s"],
    months: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"],
    monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    today: "Aujourd'hui",
    clear: "Effacer",
    format: "dd/mm/yyyy",
    titleFormat: "MM yyyy",
    weekStart: 1
};

$('#datepicker').datepicker({
    language: 'fr',
    autoclose: true,
    todayHighlight: true,
    daysOfWeekDisabled: "2",
    startDate: '0',
    endDate: '+2y',
    daysOfWeekHighlighted: '0',
    datesDisabled: closingDays,
    beforeShowDay: Highlight

});

$('#datepicker').on('changeDate', function() {
    $('#my_hidden_input').val(
        $('#datepicker').datepicker('getFormattedDate')
    );
});