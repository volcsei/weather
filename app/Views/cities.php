<?php
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <link href="<?= base_url('assets/css/datatables.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/sweetalert2.min.css') ?>" rel="stylesheet">

    <script type="module" src="<?= base_url('assets/js/jquery-3.7.0.js') ?>"></script>
    <script type="module" src="<?= base_url('assets/js/jquery.dataTables.min.js') ?>"></script>
    <script type="module" src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
    <script type="module" src="<?= base_url('assets/js/bootstrap.js') ?>"></script>
    <script type="module" src="<?= base_url('assets/js/datatables.min.js') ?>"></script>
    <script type="module" src="<?= base_url('assets/js/sweetalert2.all.min.js') ?>"></script>
    <script type="module" src="<?= base_url('assets/js/cities/cities.js') ?>"></script>
</head>
<body>
<div class="col-lg-8 mx-auto p-4 py-md-5">
    <main>
        <div class="row">
            <div class="col-6">
                <h2 class="mb-5">Városok kezelése</h2>
            </div>
            <div class="col-6 text-right">
                <button type="button" id="newCityBtn" class="btn btn-primary" data-toggle="modal" data-target="#cityModal">
                    Új város hozzáadása
                </button>
                <a href="<?= base_url('cronjobs/getCitiesWeatherData') ?>"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cityModal">
                    Időjárás lekérdezés cronjob
                </button></a>
            </div>
        </div>

        <table id="citiesTable" class="display w-100">

        </table>

        <div class="modal fade" id="cityModal" tabindex="-1" role="dialog" aria-labelledby="cityModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cityModalLabel">Város kezelése</h5>
                        <button id="city_modal_close_btn" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="city_modal_form">
                            <input type="hidden" id="city-id" name="id">
                            <div class="row">
                                <div class="col-12 form-group">
                                    <label for="city_name">Város neve</label>
                                    <input class="form-control" type="text" name="name" id="city_name" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 form-group">
                                    <label for="city_latitude">Hosszúsági fok</label>
                                    <input class="form-control" type="number" name="name" id="city_latitude" value="">
                                </div>
                                <div class="col-6 form-group">
                                    <label for="city_longitude">Szélességi fok</label>
                                    <input class="form-control" type="number" name="name" id="city_longitude" value="">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="city_modal_cancel_btn" class="btn btn-secondary" data-dismiss="modal">Mégsem</button>
                        <button type="button" id="city_modal_save_btn" class="btn btn-primary">Mentés</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>



</body>
</html>



