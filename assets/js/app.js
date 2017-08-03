
if ($('.ct-chart-browser').length) {
  (function () {
    var data = {
      series: [1000, 480, 705, 105, 50]
    };

    var sum = function sum(a, b) {
      return a + b;
    };

    new Chartist.Pie('.ct-chart-browser', data, {
      labelInterpolationFnc: function labelInterpolationFnc(value) {
        return Math.round(value / data.series.reduce(sum) * 100) + '%';
      },
      labelPosition: 'inside',
      startAngle: 270
    });
  })();
}

if ($('.ct-chart-os').length) {
  (function () {
    var data = {
      series: [1300, 200, 605, 205, 100]
    };

    var sum = function sum(a, b) {
      return a + b;
    };

    new Chartist.Pie('.ct-chart-os', data, {
      labelInterpolationFnc: function labelInterpolationFnc(value) {
        return Math.round(value / data.series.reduce(sum) * 100) + '%';
      },
      startAngle: 270,
      donut: true,
      donutWidth: 20,
      labelPosition: 'outside',
      labelOffset: -30
    });
  })();
}

$(".tab-stats a[data-toggle='tab']").on("shown.bs.tab", function (e) {
  $(e.currentTarget.hash).find('.chart').each(function (el, tab) {
    tab.__chartist__.update();
  });
});

if ($('.ct-chart-sale').length) {
  new Chartist.Line('.ct-chart-sale', {
    labels: ["10:20", "10:30", "10:40", "10:50", "11:00", "11:10", "11:20", "11:30", "11:40", "11:50", "12:00", "12:10", "12:20", "12:30", "12:40", "12:50", "13:00", "13:10", "13:20", "13:30"],
    series: [[2710, 2810, 4210, 8010, 19158, 35326, 80837, 79477, 88561, 67807, 70837, 55261, 66216, 10516, 13493, 12000, 14253, 33506, 56326, 78986, 20747, 44165, 13817]]
  }, {
    axisX: {
      position: 'center'
    },
    axisY: {
      offset: 0,
      showLabel: false,
      labelInterpolationFnc: function labelInterpolationFnc(value) {
        return value / 1000 + 'k';
      }
    },
    chartPadding: {
      top: 0,
      right: 0,
      bottom: 0,
      left: 0
    },
    height: 250,
    high: 120000,
    showArea: true,
    stackBars: true,
    fullWidth: true,
    lineSmooth: false,
    plugins: [Chartist.plugins.ctPointLabels({
      textAnchor: 'left',
      labelInterpolationFnc: function labelInterpolationFnc(value) {
        return '$' + parseInt(value / 1000) + 'k';
      }
    })]
  }, [['screen and (max-width: 768px)', {
    axisX: {
      offset: 0,
      showLabel: false
    },
    height: 180
  }]]);
}

var timeout = null;

$(".app-login form").on("submit", function (e) {
  e.preventDefault();

  $(".app-login .app-container").addClass("__loading");

  clearTimeout(timeout);
  timeout = setTimeout(function () {
    $(".app-login .app-container").removeClass("__loading");
  }, 3000);
});

/* autocomplete search */
var countries = [{ value: 'Andorra', data: 'AD' }, { value: 'Zimbabwe', data: 'ZZ' }];

$('#search').autocomplete({
  lookup: countries
});

$(".sidebar-toggle").bind("click", function (e) {
  $("#sidebar").toggleClass("active");
  $(".app-container").toggleClass("__sidebar");
});

$(".navbar-toggle").bind("click", function (e) {
  $("#navbar").toggleClass("active");
  $(".app-container").toggleClass("__navbar");
});

$('input[name=theming]').on('change', function () {
        $(".app").removeClass("app-blue-sky").removeClass("app-yellow").removeClass("app-red").removeClass("app-green").removeClass("app-default").addClass("app-" + $(this).val());
});

if ($('.ct-chart').length) {
  new Chartist.Line('.ct-chart', {
    labels: [2015, 2016, 2017, 2018, 2019],
    series: [[7684, 8356, 9108, 7508, 6988], [2961, 4500, 6302, 2433, 3594]]
  }, {
    showArea: true,
    fullWidth: true,
    lineSmooth: false
  });
}

if ($('.ct-chart-bar').length) {
  new Chartist.Bar('.ct-chart-bar', {
    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
    series: [[12, 9, 7, 8, 5], [2, 1, 3.5, 7, 3], [1, 3, 4, 5, 6]]
  }, {
    fullWidth: true,
    chartPadding: {
      right: 40
    }
  });
}

if ($('.ct-chart-pie').length) {
  (function () {
    var data = {
      series: [5, 3, 4]
    };

    var sum = function sum(a, b) {
      return a + b;
    };

    new Chartist.Pie('.ct-chart-pie', data, {
      labelInterpolationFnc: function labelInterpolationFnc(value) {
        return Math.round(value / data.series.reduce(sum) * 100) + '%';
      }
    });
  })();
}

if ($('.ct-chart-donut').length) {
  (function () {
    var data = {
      series: [5, 3, 4]
    };

    var sum = function sum(a, b) {
      return a + b;
    };

    new Chartist.Pie('.ct-chart-donut', data, {
      labelInterpolationFnc: function labelInterpolationFnc(value) {
        return Math.round(value / data.series.reduce(sum) * 100) + '%';
      },
      donut: true,
      donutWidth: 20,
      labelPosition: 'outside',
      labelOffset: -30
    });
  })();
}

if ($('.ct-chart-bi-polar').length) {
  new Chartist.Line('.ct-chart-bi-polar', {
    labels: [1, 2, 3, 4, 5, 6, 7, 8],
    series: [[1, 2, 3, 1, -2, 0, 1, 0], [-2, -1, -2, -1, -2.5, -1, -2, -1], [0, 0, 0, 1, 2, 2.5, 2, 1]]
  }, {
    high: 3,
    low: -3,
    showArea: true,
    showLine: false,
    showPoint: false,
    fullWidth: true,
    axisX: {
      showLabel: false,
      showGrid: false
    }
  });
}

if ($('.ct-chart-stack-bar').length) {
  new Chartist.Bar('.ct-chart-stack-bar', {
    labels: ['Q1', 'Q2', 'Q3', 'Q4'],
    series: [[800000, 1200000, 1400000, 1300000], [200000, 400000, 500000, 300000], [100000, 200000, 400000, 600000]]
  }, {
    stackBars: true,
    axisY: {
      labelInterpolationFnc: function labelInterpolationFnc(value) {
        return value / 1000 + 'k';
      }
    }
  }).on('draw', function (data) {
    if (data.type === 'bar') {
      data.element.attr({
        style: 'stroke-width: 30px'
      });
    }
  });
}

/* Highlight.js */
hljs.initHighlightingOnLoad();
// hljs.initLineNumbersOnLoad();

$(document).click(function (event) {
  if (!$(event.target).closest('.btn-floating').length) {
    if ($('.btn-floating .toggle-content').is(":visible")) {
      $('.btn-floating').toggleClass("active");
    }
  }
});


$(".select2").select2();

var datatable = $('.datatable').DataTable({
  "dom": '<"top"fl<"clear">>rt<"bottom"ip<"clear">>',
  "oLanguage": {
    "sSearch": "",
    "sLengthMenu": "_MENU_"
  },
  "initComplete": function initComplete(settings, json) {
    $('div.dataTables_filter input').attr('placeholder', 'Search...');
    // $(".dataTables_wrapper select").select2({
    //   minimumResultsForSearch: Infinity
    // });
  }
});

$('[data-toggle="toggle"]').bind("click", function () {
  var elm = $(this);
  var target = elm.attr("data-target");
  var targetElm = $(target);

  targetElm.toggleClass("active");
});