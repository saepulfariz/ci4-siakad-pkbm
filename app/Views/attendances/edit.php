<?= $this->extend('template/index') ?>

<?= $this->section('content') ?>
<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= temp_lang('app.edit'); ?> <?= temp_lang('attendances.attendance'); ?></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Home</a></li>
                    <li class="breadcrumb-item">Data <?= $title; ?></li>
                    <li class="breadcrumb-item active"><?= temp_lang('app.edit'); ?></li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <form action="<?= base_url($link . '/' . $attendance->id); ?>" method="post">
            <?= csrf_field(); ?>
            <input type="hidden" name="_method" value="PUT">

            <div class="row">
                <div class="col-12 col-xl-4">
                    <div class="card">
                        <div class="card-body">

                            <?php if (auth()->user()->can('attendances.access-all')): ?>

                                <!-- TYPE -->
                                <div class="form-group">
                                    <label for="type"><?= temp_lang('attendances.type'); ?></label>
                                    <select id="type" name="type"
                                        class="form-control <?= ($error = validation_show_error('type')) ? 'border-danger' : ''; ?>">
                                        <option value="">== SELECT ==</option>
                                        <?php foreach ($types as $type): ?>
                                            <?php $type_name = ($type['id'] == 'student') ? temp_lang('students.' . $type['id']) : temp_lang('teachers.' . $type['id']) ?>
                                            <option value="<?= $type['id']; ?>"
                                                <?= old('type', $attendance->type) == $type['id'] ? 'selected' : ''; ?>>
                                                <?= $type_name; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <?= $error ? '<div class="text-danger mb-2">' . $error . '</div>' : ''; ?>

                                <!-- USER (AJAX) -->
                                <div class="form-group">
                                    <label for="user_id"><?= temp_lang('attendances.name'); ?></label>
                                    <select id="user_id" name="user_id"
                                        class="form-control <?= validation_show_error('user_id') ? 'border-danger' : ''; ?>"
                                        disabled>
                                    </select>
                                </div>
                                <?= validation_show_error('user_id')
                                    ? '<div class="text-danger mb-2">' . validation_show_error('user_id') . '</div>'
                                    : ''; ?>

                            <?php endif; ?>

                            <!-- STATUS -->
                            <div class="form-group">
                                <label for="status"><?= temp_lang('attendances.status'); ?></label>
                                <select id="status" name="status"
                                    class="form-control <?= validation_show_error('status') ? 'border-danger' : ''; ?>">
                                    <option value="">== SELECT ==</option>
                                    <?php foreach ($status as $st): ?>
                                        <option value="<?= $st['id']; ?>"
                                            <?= old('status', $attendance->status) == $st['id'] ? 'selected' : ''; ?>>
                                            <?= temp_lang('attendances.' . $st['id']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?= validation_show_error('status')
                                ? '<div class="text-danger mb-2">' . validation_show_error('status') . '</div>'
                                : ''; ?>

                            <?php if (auth()->user()->can('attendances.access-all')): ?>

                                <!-- DATE -->
                                <div class="form-group">
                                    <label for="date"><?= temp_lang('attendances.date'); ?></label>
                                    <input type="date" id="date" name="date"
                                        class="form-control <?= validation_show_error('date') ? 'border-danger' : ''; ?>"
                                        value="<?= old('date', $attendance->date); ?>">
                                </div>
                                <?= validation_show_error('date')
                                    ? '<div class="text-danger mb-2">' . validation_show_error('date') . '</div>'
                                    : ''; ?>

                            <?php endif; ?>

                            <!-- DESCRIPTION -->
                            <div class="form-group">
                                <label for="description"><?= temp_lang('attendances.description'); ?></label>
                                <textarea id="description" name="description"
                                    class="form-control <?= validation_show_error('description') ? 'border-danger' : ''; ?>"
                                    placeholder="<?= temp_lang('attendances.description'); ?>"><?= old('description', $attendance->description); ?></textarea>
                            </div>
                            <?= validation_show_error('description')
                                ? '<div class="text-danger mb-2">' . validation_show_error('description') . '</div>'
                                : ''; ?>

                            <button type="submit" class="btn btn-primary"><?= temp_lang('app.update'); ?></button>
                            <a href="<?= base_url($link); ?>" class="btn btn-secondary"><?= temp_lang('app.cancel'); ?></a>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    function getUsers(id = null) {
        let type = $('#type').val();
        let $select = $('#user_id');

        $select.prop('disabled', true);
        $select.html('<option>Loading...</option>');

        $.getJSON('<?= base_url($link . '/ajax_users'); ?>', {
            type: type
        }, function(res) {
            $select.empty();

            if (res.success !== false) {
                let users = res.data ?? res;
                $select.append('<option value="">-- Pilih User --</option>');

                $.each(users, function(_, user) {
                    let selected = (id == user.id) ? 'selected' : '';
                    $select.append(`<option value="${user.id}" ${selected}>${user.full_name}</option>`);
                });

                $select.prop('disabled', false);
            } else {
                $select.append('<option>Data tidak ditemukan</option>');
            }
        });
    }

    // load saat edit
    getUsers(<?= old('user_id', $attendance->user_id); ?>);

    $('#type').on('change', function() {
        getUsers();
    });
</script>
<?= $this->endSection() ?>