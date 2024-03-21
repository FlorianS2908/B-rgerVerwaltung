var CALENDAR = function () {
    var cal = {};
    var wrap, label;
    var months = ["Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember"];

    cal.init = function (newWrap) {
        wrap = $(newWrap);
        label = wrap.find("#label");
        wrap.find("#prev").on("click", function () { switchMonth(false); });
        wrap.find("#next").on("click", function () { switchMonth(true); });
        label.on("click", function () { switchMonth(null, new Date().getMonth(), new Date().getFullYear()); });
        label.click();

    };

    function switchMonth(next, month, year) {
        var curr = label.text().trim().split(" "), tempYear = parseInt(curr[1], 10);
        month = month || ((next) ? ((curr[0] === "Dezember") ? 0 : months.indexOf(curr[0]) + 1) : ((curr[0] === "January") ? 11 : months.indexOf(curr[0]) - 1));
        year = year || ((next && month === 0) ? tempYear + 1 : (!next && month === 11) ? tempYear - 1 : tempYear);

        var calendar = createCal(year, month);
        $("#cal-frame", wrap)
            .find(".curr")
            .removeClass("curr")
            .addClass("temp")
            .end()
            .prepend(calendar.calendar())
            .find(".temp")
            .fadeOut("slow", function () { $(this).remove(); });

        $('#label').text(calendar.label);

    }

    function createCal(year, month) {
        var day = 1, i, j,
            startDay = new Date(year, month, day).getDay(),
            daysInMonth = [31, (((year % 4 == 0) && (year % 100 != 0)) || (year % 400 == 0)) ? 29 : 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31],
            calendar = [];

        if (!createCal.cache) {
            createCal.cache = {};
        }

        if (createCal.cache[year] && createCal.cache[year][month]) {
            return createCal.cache[year][month];
        }

        while (true) {
            calendar.push([]);
            for (j = 0; j < 7; j++) {
                if (calendar.length === 1 && j < startDay) {
                    calendar[0].push("");
                } else if (day <= daysInMonth[month]) {
                    calendar[calendar.length - 1].push(day++);
                } else {
                    calendar[calendar.length - 1].push("");
                }
            }
            if (day > daysInMonth[month]) {
                break;
            }
        }

        for (i = 0; i < calendar.length; i++) {
            calendar[i] = "<tr>" + calendar[i].map(function (day, index) {
                // Check if the current day is Sunday (index 0 represents Sunday)
                var isSunday = index === 6;
                // Generate id for the td element based on whether it's Sunday or not
                var tdId = isSunday ? "sunday" : "";
                // For each day in the row, generate a table cell with a div (if day is not empty)
                return "<td id='" + tdId + "'>" + (day ? ("<div onclick=\"updateDate('" + day + "', '" + month + "', '" + year + "')\">" + day + "</div>") : "") + "</td>";
            }).join("") + "</tr>"; // Join the table cells to form the row
        }

        calendar = $("<table>" + calendar.join("") + "</table>").addClass("curr");

        $("td:empty", calendar).addClass("nil");
        if (month === new Date().getMonth()) {
            $('td', calendar).filter(function () { return $(this).text() === new Date().getDate().toString(); }).addClass("today");
        }

        createCal.cache[year] = createCal.cache[year] || {};
        createCal.cache[year][month] = {
            calendar: function () { return calendar.clone() },
            label: months[month] + " " + year
        };

        return createCal.cache[year][month];
    }

    return cal;
};


function updateDate(day, month, year) {

    var label = document.getElementById('datum');

    day = day < 10 ? '0' + day : day;
    month = parseInt(month) + 1;
    month = month < 10 ? '0' + month : month;

    label.textContent = day + '.' + month + '.' + year;
}