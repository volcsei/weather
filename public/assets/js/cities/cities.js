
document.addEventListener("DOMContentLoaded", function() {

    var base_url = (page = '') => {
        let port = (window.location.port.length > 0) ? ':' + window.location.port : '';
        return window.location.protocol + '//' + window.location.hostname + port + '/' + page;
    }

    //region Városok táblázat

    var dataTable;

    const table = document.querySelector('#citiesTable');
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4) {
            if (xhr.status !== 200) {
                this.console('Szerverhiba' + xmlhttp.status);
                return;
            }

            const response = JSON.parse(xhr.responseText);
            if(response['type'] === 'success') {
                dataTable = new DataTable("#citiesTable", {
                    data: response['data'],
                    columns: [
                        { title: "Név", data: "name" },
                        { title: "Hosszúsági fok", data: "longitude" },
                        { title: "Szélességi fok", data: "latitude" },
                        {
                            title: "Műveletek",
                            data: null,
                            render: function(data, type, row) {
                                return '<button class="mr-2" data-event="edit" data-id="' + row.id + '">Szerkesztés</button><button data-event="del" data-id="' + row.id + '">Törlés</button>';
                            }
                        }
                    ],
                    rowId: 'id',
                });
            }
        }
    };

    xhr.open('POST', base_url('home/getCityTableData'), true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.send();

    if(table) table.addEventListener('click', (e) => {
        console.log(e.target)
        if(e.target.dataset.event === 'del') eventDelete(e);
        if(e.target.dataset.event === 'edit') eventEdit(e);
    })

    function addNewRecord(record) {
        dataTable.row.add(record).draw();
    }

    const eventDelete = (e) => {
        const id = e.target.dataset.id;

        const formData = new FormData();
        formData.append('id', id);

        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4) {
                if (xhr.status !== 200) {
                    this.console('Szerverhiba' + xmlhttp.status);
                    return;
                }

                const response = JSON.parse(xhr.responseText);
                if(response['type'] === 'success') {
                    e.target.closest('tr').remove();
                }
            }
        };

        xhr.open('POST', base_url('home/deleteCity'), true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.send(formData);
    }

    const eventEdit = (e) => {
        const id = e.target.dataset.id;
        const data = dataTable.row('#' + id).data();

        if(data){
            document.querySelector('#city-id').value = data['id'];
            document.querySelector('#city_name').value = data['name'];
            document.querySelector('#city_latitude').value = data['latitude'];
            document.querySelector('#city_longitude').value = data['longitude'];
            $('#cityModal').modal('show')
        }

    }

    //endregion

    //region Város modal

    const newCityBtn = document.querySelector('#newCityBtn');
    if(newCityBtn) newCityBtn.addEventListener('click', () => {
        $('#cityModal').modal('show')
    })

    const modalCancelBtn = document.querySelector('#city_modal_cancel_btn');
    const modalSaveBtn = document.querySelector('#city_modal_save_btn');
    const modalCloseBtn = document.querySelector('#city_modal_close_btn');

    if(modalCancelBtn) modalCancelBtn.addEventListener('click', () => {
        $('#cityModal').modal('hide')
    })

    if(modalCloseBtn) modalCloseBtn.addEventListener('click', () => {
        $('#cityModal').modal('hide')
    })

    $('#cityModal').on('hidden.bs.modal', function (e) {
        $('#city_modal_form')[0].reset();
        document.querySelector('#city-id').value = '';
    });

    $("#cityModal").on('hidden.bs.modal', function () {
        $(this).data('bs.modal', null);
    });

    if(modalSaveBtn) modalSaveBtn.addEventListener('click', () => {
        const id = document.querySelector('#city-id')?.value;

        const formData = new FormData();
        formData.append('id', id);
        formData.append('name', document.querySelector('#city_name')?.value);
        formData.append('longitude', document.querySelector('#city_longitude')?.value);
        formData.append('latitude', document.querySelector('#city_latitude')?.value);

        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = () => {
            if (xhr.readyState === 4) {
                if (xhr.status !== 200) {
                    this.console('Szerverhiba' + xmlhttp.status);
                    return;
                }

                const response = JSON.parse(xhr.responseText);
                if(response['type'] === 'success') {
                    $('#cityModal').modal('hide');
                    if(id) {
                        let rowIndex = dataTable.row('#' + id).index();
                        dataTable.row(rowIndex).data(response['data']).draw();
                    } else {
                        addNewRecord(response['data']);
                    }
                }
            }
        };

        xhr.open('POST', base_url('home/saveCity'), true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.send(formData);
    });

    //endregion


});