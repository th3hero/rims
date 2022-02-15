SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+05:30";


CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hospital_id` bigint(20) UNSIGNED NOT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `departments` (`id`, `hospital_id`, `department`, `created_at`, `updated_at`) VALUES
(1, 1, 'ENT', current_timestamp(), current_timestamp()),
(2, 1, 'Cardiology', current_timestamp(), current_timestamp()),
(3, 1, 'Muscle', current_timestamp(), current_timestamp()),
(4, 1, 'Skin', current_timestamp(), current_timestamp()),
(5, 1, 'OPD', current_timestamp(), current_timestamp()),
(6, 2, 'ENT', current_timestamp(), current_timestamp()),
(7, 2, 'Cardiology', current_timestamp(), current_timestamp()),
(8, 2, 'Skin', current_timestamp(), current_timestamp()),
(9, 2, 'OPD', current_timestamp(), current_timestamp()),
(10, 3, 'ENT', current_timestamp(), current_timestamp()),
(11, 3, 'Cardiology', current_timestamp(), current_timestamp()),
(12, 3, 'Muscle', current_timestamp(), current_timestamp()),
(13, 3, 'Skin', current_timestamp(), current_timestamp()),
(14, 3, 'OPD', current_timestamp(), current_timestamp());


CREATE TABLE `hospitals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `hospitals` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Hindurao Hospital', 1, current_timestamp(), current_timestamp()),
(2, 'AIIMS', 1, current_timestamp(), current_timestamp()),
(3, 'Ambedkar Hospital', 1, current_timestamp(), current_timestamp());

CREATE TABLE `patients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hospital_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `patients` (`id`, `name`, `email`, `phone`, `hospital_id`, `department_id`, `created_at`, `updated_at`) VALUES
(1, 'Rajeev Chauhan', 'rajeev@gmail.com', '7042184137', 1, 1, current_timestamp(), current_timestamp());


ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departments_hospital_id_foreign` (`hospital_id`);

ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `patients_email_unique` (`email`),
  ADD KEY `patients_hospital_id_foreign` (`hospital_id`),
  ADD KEY `patients_department_id_foreign` (`department_id`);

ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

ALTER TABLE `hospitals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `patients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `departments`
  ADD CONSTRAINT `departments_hospital_id_foreign` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `patients`
  ADD CONSTRAINT `patients_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patients_hospital_id_foreign` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
