$(document).ready(function () {
    let from, to;
    to = $("#to").persianDatepicker({
        altField: '[name=to]',
        initialValue: false,
        observer: true,
        autoClose: true,
        format: 'YYYY/MM/DD',
        onSelect: function (unix) {
            to.touched = true;
            if (from && from.options && from.options.maxDate !== unix) {
                let cachedValue = from.getState().selected.unixDate;
                from.options = {maxDate: unix};
                if (from.touched) {
                    from.setDate(cachedValue);
                }
            }
        }
    });

    from = $("#from").persianDatepicker({
        altField: '[name=from]',
        initialValue: false,
        observer: true,
        autoClose: true,
        format: 'YYYY/MM/DD',
        onSelect: function (unix) {
            from.touched = true;
            if (to && to.options && to.options.minDate !== unix) {
                let cachedValue = to.getState().selected.unixDate;
                to.options = {minDate: unix};
                if (to.touched) {
                    to.setDate(cachedValue);
                }
            }
        }
    });
});
