/* The MIT License (MIT)

Copyright (c) 2015 Alessandro De Micheli

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE. */

$(document).ready(function() {

    var points = 0;
    var ratings = [
        "Peasantry",
        "Compromised",
        "Mediocre",
        "Righteous",
        "Glorious"
    ];

    $.fn.Colorize = function(e) {
        $("input:radio[name=" + $(e).attr("name") + "]")
            .prop("checked", false)
            .parents("td")
            .removeClass("checked");

        $(e).prop("checked", true)
            .parents("td")
            .toggleClass("checked");
    }

    $.fn.Compute = function() {
        var selected = $("input:radio:checked");
        var opacity = 0;
        points = 0;

        $(selected).each(function(index) {
            var id = $(this).attr("id");
            var section = id.substring(0, 2);
            var weight = parseInt(id.substring(4, 5));
            var score = parseInt(id.substring(6));
            points += (weight * score);
            opacity += 0.1;
            $('img.rating')
                .css({'opacity': opacity});
        });

        $('span.score').text(points);
    }

    $.fn.Glorify = function() {
        var rating;
        if (points >= 0   && points <= 39 ) { rating = 0; }
        if (points >= 40  && points <= 79 ) { rating = 1; }
        if (points >= 80  && points <= 119) { rating = 2; }
        if (points >= 120 && points <= 159) { rating = 3; }
        if (points >= 160 && points <= 200) { rating = 4; }

        var r = ratings[rating];
        $('span.rating').html('<strong>' + r.substring(0, 1) + '</strong>' + r.substring(1));
        $('img.rating').attr("src", "images/ratings/" + rating + ".jpg");
    }

    $.fn.CheckScore = function(e) {
        $.fn.Colorize(e);
        $.fn.Compute();
        $.fn.Glorify();
    }




    $('td.score.description').click(function(event) {
        event.preventDefault();

        var selected = $(this).find("input:radio");
            $(selected).prop("checked", true);
            $.fn.CheckScore(selected);
    });

    $('img.rating').click(function(e) {
        $(this)
            .toggleClass("twelve columns")
            .toggleClass("two columns")
            .toggleClass("absolute")
            .toggleClass("u-max-full-width");
    });

});
