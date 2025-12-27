<?= $this->extend('template/index') ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Student</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Home</a></li>
                    <li class="breadcrumb-item">Data <?= $title; ?></li>
                    <li class="breadcrumb-item active">Edit</li>
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
        <form action="<?= base_url($link . '/' . $student->id); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <input type='hidden' name='_method' value='PUT' />
            <div class="row">
                <div class="col-12 col-xl-4">
                    <div class="card">
                        <div class="card-body">

                            <div class="form-group">
                                <label for="user_id">User</label>
                                <select type="text" class="form-control <?= ($error = validation_show_error('user_id')) ? 'border-danger' : ((old('user_id')) ? 'border-success' : ''); ?> " value="<?= old('user_id'); ?>" id="user_id" name="user_id">
                                    <option value="">== NONE ===</option>
                                    <?php foreach ($users as $user): ?>
                                        <?php if (old('user_id')): ?>
                                            <?php if (old('user_id', $student->user_id) == $user->id): ?>
                                                <option selected value="<?= $user->id; ?>"><?= $user->username; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $user->id; ?>"><?= $user->username; ?></option>
                                            <?php endif; ?>
                                        <?php else: ?>

                                            <?php if ($student->user_id == $user->id): ?>
                                                <option selected value="<?= $user->id; ?>"><?= $user->username; ?></option>
                                            <?php else: ?>
                                                <option value="<?= $user->id; ?>"><?= $user->username; ?></option>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('user_id')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>

                            <div class="form-group">
                                <label for="nis">NIS <small class="fw-weight-bold text-danger"><b>*</b></small></label>
                                <input type="text" class="form-control <?= ($error = validation_show_error('nis')) ? 'border-danger' : ((old('nis')) ? 'border-success' : ''); ?>" id="nis" name="nis" placeholder="" value="<?= old('nis', $student->nis); ?>">
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('nis')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>

                            <div class="form-group">
                                <label for="nisn">NISN <small class="fw-weight-bold text-danger"><b>*</b></small></label>
                                <input type="text" class="form-control <?= ($error = validation_show_error('nisn')) ? 'border-danger' : ((old('nisn')) ? 'border-success' : ''); ?>" id="nisn" name="nisn" placeholder="" value="<?= old('nisn', $student->nisn); ?>">
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('nisn')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>

                            <div class="form-group">
                                <label for="full_name">Full Name <small class="fw-weight-bold text-danger"><b>*</b></small></label>
                                <input type="text" class="form-control <?= ($error = validation_show_error('full_name')) ? 'border-danger' : ((old('full_name')) ? 'border-success' : ''); ?>" id="full_name" name="full_name" placeholder="" value="<?= old('full_name', $student->full_name); ?>">
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('full_name')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>


                            <div class="form-group">
                                <label for="gender">Gender <small class="fw-weight-bold text-danger"><b>*</b></small></label>
                                <select name="gender" id="gender" class="form-control <?= ($error = validation_show_error('gender')) ? 'border-danger' : ((old('gender')) ? 'border-success' : ''); ?>">
                                    <option value="L" <?= (old('gender', $student->gender) == 'L') ? 'selected' : ''; ?>>LAKI-LAKI</option>
                                    <option value="P" <?= (old('gender', $student->gender) == 'P') ? 'selected' : ''; ?>>PEREMPUAN</option>
                                </select>
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('gender')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>

                            <div class="form-group">
                                <label for="birth_place">Birth Place <small class="fw-weight-bold text-danger"><b>*</b></small></label>
                                <input type="text" class="form-control <?= ($error = validation_show_error('birth_place')) ? 'border-danger' : ((old('birth_place')) ? 'border-success' : ''); ?>" id="birth_place" name="birth_place" placeholder="" value="<?= old('birth_place', $student->birth_place); ?>">
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('birth_place')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>

                            <div class="form-group">
                                <label for="birth_date">Birth Date</label>
                                <input type="date" class="form-control <?= ($error = validation_show_error('birth_date')) ? 'border-danger' : ((old('birth_date')) ? 'border-success' : ''); ?>" id="birth_date" name="birth_date" placeholder="<?= date('Y'); ?>" value="<?= old('birth_date', $student->birth_date); ?>">
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('birth_date')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>


                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea class="form-control <?= ($error = validation_show_error('address')) ? 'border-danger' : ((old('address')) ? 'border-success' : ''); ?>" id="address" name="address"><?= old('address', $student->address); ?></textarea>
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('address')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>


                            <div class="form-group">
                                <label for="phone">Phone <small class="fw-weight-bold text-danger"><b>*</b></small></label>
                                <input type="text" class="form-control <?= ($error = validation_show_error('phone')) ? 'border-danger' : ((old('phone')) ? 'border-success' : ''); ?>" id="phone" name="phone" placeholder="" value="<?= old('phone', $student->phone); ?>">
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('phone')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>

                            <div class="form-group">
                                <label for="parent_name">Parent Name <small class="fw-weight-bold text-danger"><b>*</b></small></label>
                                <input type="text" class="form-control <?= ($error = validation_show_error('parent_name')) ? 'border-danger' : ((old('parent_name')) ? 'border-success' : ''); ?>" id="parent_name" name="parent_name" placeholder="Parent Name" value="<?= old('parent_name', $student->parent_name); ?>">
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('parent_name')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>

                            <div class="form-group">
                                <label for="photo">Photo <small class="fw-weight-bold text-danger"><b>*</b></small></label>
                                <input type="file" class="form-control <?= ($error = validation_show_error('photo')) ? 'border-danger' : ((old('photo')) ? 'border-success' : ''); ?>" id="photo" name="photo">
                            </div>
                            <?= ($error) ? '<div class="error text-danger mb-2" style="margin-top: -15px">' . $error . '</div>' : ''; ?>
                            <?= (old('photo')) ? '<div class="error text-success mb-2" style="margin-top: -15px">Looks good!</div>' : ''; ?>

                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="<?= base_url($link); ?>" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </div>

            </div>
        </form>


    </div>
</section>
<?= $this->endSection('content') ?>