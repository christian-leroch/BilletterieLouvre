function Holidays(year){
    var holidays = [];
    for ( var i=0; i<= 2;i++) {
        var NewYearsDay = new Date(Date.UTC(year+i, "00", "01"));
        var LaborDay = new Date(Date.UTC(year+i, "04", "01"));
        var Victory1945 = new Date(Date.UTC(year+i, "04", "08"));
        var NationalHoliday = new Date(Date.UTC(year+i,"06", "14"));
        var Assumption = new Date(Date.UTC(year+i, "07", "15"));
        var AllSaintsDay = new Date(Date.UTC(year+i, "10", "01"));
        var Armistice = new Date(Date.UTC(year+i, "10", "11"));
        var ChristmasDay = new Date(Date.UTC(year+i, "11", "25"));

        var G = (year+i)%19;
        var C = Math.floor((year+i)/100);
        var H = (C - Math.floor(C/4) - Math.floor((8*C+13)/25) + 19*G + 15)%30;
        var I = H - Math.floor(H/28)*(1 - Math.floor(H/28)*Math.floor(29/(H + 1))*Math.floor((21 - G)/11));
        var J = ((year+i)*1 + Math.floor((year+i)/4) + I + 2 - C + Math.floor(C/4))%7;
        var L = I - J;
        var EasterMonth = 3 + Math.floor((L + 40)/44);
        var EasterSunday = L + 28 - 31*Math.floor(EasterMonth/4);
        var EasterMonday = new Date(Date.UTC(year+i, EasterMonth-1, EasterSunday+1));
        var AscensionThursday = new Date(Date.UTC(year+i, EasterMonth-1, EasterSunday+39));
        var PentecostMonday = new Date(Date.UTC(year+i, EasterMonth-1, EasterSunday+50));

        holidays.push(NewYearsDay, EasterMonday, LaborDay, Victory1945, AscensionThursday, PentecostMonday, NationalHoliday, Assumption, AllSaintsDay, Armistice, ChristmasDay);
    }
    return holidays;
}

function ClosingDays(year) {
    var closingDays = [];
    for (var j = 0; j <= 2; j++) {
        var LaborDay = new Date(Date.UTC(year + j, "04", "01"));
        var AllSaintsDay = new Date(Date.UTC(year + j, "10", "01"));
        var ChristmasDay = new Date(Date.UTC(year + j, "11", "25"));

        closingDays.push(LaborDay, AllSaintsDay, ChristmasDay);
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
var year          = today.getFullYear();
var holiday     = Holidays(year);
var closingDays = ClosingDays(year);

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