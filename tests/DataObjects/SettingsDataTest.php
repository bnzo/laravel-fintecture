<?php

it('setting', function () {
    $settingsData = new \Bnzo\Fintecture\Data\SettingsData(
        dueAt: now()->addHours(24),
        expiresAt: now()->addHours(24),
    );

    eval(\Psy\sh());
});
