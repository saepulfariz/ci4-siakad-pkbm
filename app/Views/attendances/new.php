<?= $this->extend('template/index') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= temp_lang('app.new'); ?> <?= temp_lang('attendances.attendance'); ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Home</a></li>
                    <li class="breadcrumb-item">Data <?= $title; ?></li>
                    <li class="breadcrumb-item active"><?= temp_lang('app.new'); ?></li>
                </ol>
            </div>
            <!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <form action="<?= base_url($link); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="row">
                <div class="col-12 col-xl-4">
                    <div class="card">
                        <div class="card-body">

                            <?php if (auth()->user()->can('attendances.access-all')): ?>

                                <div class="form-group">
                                    <label for="type"><?= temp_lang('attendances.type'); ?></label>
                                    <select type="text" class="form-control <?= ($error = validation_show_error('type')) ? 'border-danger' : ((old('type')) ? 'border-success' : ''); ?> " value="<?= old('type'); ?>" id="type" name="type">
                                        <option value="">== SELECT ==</option>
                                        <?php foreach ($types as $type): ?>
                                            <?php $type_name = ($type['id'] == 'student') ? temp_lang('students.' . $type['id']) : temp_lang('teachers.' . $type['id']) ?>
                                            <?php if (old('type')): ?>
                                                <?php if (old('type') == $type['id']): ?>
                                                    <option selected value="<?= $type['id']; ?>"><?= $type_name; ?></option>
                                                <?php else: ?>
                                                    <option value="<?= $type['id']; ?>"><?= $type_name; ?></option>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <option value="<?= $type['id']; ?>"><?= $type_name; ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                                <?= (old('type') && !$error) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>


                                <div class="form-group">
                                    <label for="user_id"><?= temp_lang('attendances.name'); ?></label>
                                    <select id="user_id" name="user_id" id="user_id" class="form-control <?= ($error = validation_show_error('user_id')) ? 'border-danger' : ((old('user_id')) ? 'border-success' : ''); ?> " disabled></select>
                                    <!-- <span id="loading-user" class="spinner-border spinner-border-sm text-primary position-absolute"
                                        style="top: 50%; right: 15px; display:none;"></span> -->
                                </div>

                                <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                                <?= (old('user_id')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>
                            <?php endif; ?>

                            <div class="form-group">
                                <label for="status"><?= temp_lang('attendances.status'); ?></label>
                                <select class="form-control <?= ($error = validation_show_error('status')) ? 'border-danger' : ((old('status')) ? 'border-success' : ''); ?> " value="<?= old('status'); ?>" id="status" name="status">
                                    <option value="">== SELECT ==</option>
                                    <?php foreach ($status as $st): ?>
                                        <?php if (old('status')): ?>
                                            <?php if (old('status') == $st['id']): ?>
                                                <option selected value="<?= $st['id']; ?>"><?= temp_lang('attendances.' . $st['id']); ?></option>
                                            <?php else: ?>
                                                <option value="<?= $st['id']; ?>"><?= temp_lang('attendances.' . $st['id']); ?></option>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <option value="<?= $st['id']; ?>"><?= temp_lang('attendances.' . $st['id']); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('status') && !$error) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>


                            <?php if (auth()->user()->can('attendances.access-all')): ?>

                                <div class="form-group">
                                    <label for="date"><?= temp_lang('attendances.date'); ?></label>
                                    <input type="date" class="form-control <?= ($error = validation_show_error('date')) ? 'border-danger' : ((old('date')) ? 'border-success' : ''); ?>" id="date" name="date" placeholder="date" value="<?= old('date', date('Y-m-d')); ?>">
                                </div>
                                <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                                <?= (old('date')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>

                            <?php endif; ?>


                            <div class="form-group">
                                <label for="description"><?= temp_lang('attendances.description'); ?></label>
                                <textarea class="form-control <?= ($error = validation_show_error('description')) ? 'border-danger' : ((old('description')) ? 'border-success' : ''); ?>" id="description" name="description" placeholder="<?= temp_lang('attendances.description'); ?>"><?= old('description'); ?></textarea>

                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('description')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>



                            <button type="submit" class="btn btn-primary"><?= temp_lang('app.save'); ?></button>
                            <a href="<?= base_url($link); ?>" class="btn btn-secondary"><?= temp_lang('app.cancel'); ?></a>



                        </div>
                    </div>
                </div>

            </div>
        </form>


    </div>
</section>
<?= $this->endSection('content') ?>


<?= $this->section('script') ?>
<script>
    function getUsers(id = null) {
        var type = $('#type').val();
        var $select = $('#user_id');

        // ===== LOADING STATE =====
        $select.prop('disabled', true);
        $select.empty();
        $select.append('<option value="">Loading...</option>');

        $('#loading-user').show();

        $.ajax({
            url: '<?= base_url($link . '/ajax_users'); ?>',
            method: 'GET',
            data: {
                type: type
            },
            dataType: 'json',
            success: function(data) {
                console.log(data);

                // reset select
                $select.empty();

                if (data.success !== false) {
                    var users = data.data ?? data;

                    $select.append('<option value="">-- Pilih User --</option>');

                    $.each(users, function(index, user) {
                        var selected = (id !== null && user.id == id) ? 'selected' : '';
                        $select.append(
                            `<option value="${user.id}" ${selected}>${user.full_name}</option>`
                        );
                    });

                    // aktifkan kembali select
                    $select.prop('disabled', false);
                } else {
                    $select.append('<option value="">Data tidak ditemukan</option>');
                }

                $('#loading-user').hide();
            },
            error: function() {
                $select.empty();
                $select.append('<option value="">Gagal load data</option>');
                $('#loading-user').hide();
            }
        });
    }

    <?php if (old('user_id')): ?>
        getUsers(<?= old('user_id'); ?>);
    <?php endif; ?>


    $('#type').on('change', getUsers);
</script>
<?= $this->endSection('script') ?>