<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - <?php echo $title; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { padding-top: 20px; }
        .container { max-width: 960px; }
        .btn-action { margin-right: 5px; }
        .alert { margin-top: 15px; }
        /* Tambahan untuk layout agar logout button lebih rapi */
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="admin-header">
            <h1 class="mb-0"><?php echo $title; ?></h1>
            <div>
                Selamat datang, **<?php echo $this->session->userdata('username'); ?>**!
                <a href="<?php echo site_url('auth/logout'); ?>" class="btn btn-sm btn-outline-danger ml-2">Logout</a>
            </div>
        </div>
        <hr>
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error_upload')): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $this->session->flashdata('error_upload'); ?>
            </div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php endif; ?>