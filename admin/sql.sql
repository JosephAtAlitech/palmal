ALTER TABLE `vehicle_master` ADD `driver_id` BIGINT NULL DEFAULT NULL AFTER `v_type`, ADD `engineer_id` BIGINT NULL DEFAULT NULL AFTER `driver_id`, ADD `edit_remarks` TEXT NULL DEFAULT NULL AFTER `engineer_id`;

ALTER TABLE `tbl_quotation` ADD `pr_generate_date` DATE NULL DEFAULT NULL AFTER `md_comments`, ADD `pr_generated_by` BIGINT NULL DEFAULT NULL AFTER `pr_generate_date`;

ALTER TABLE `tbl_quotation` ADD `ed_uplead_file` VARCHAR(555) NULL DEFAULT NULL AFTER `ed_comments`;

ALTER TABLE `tbl_token` ADD `is_delivered` INT(2) NULL DEFAULT NULL AFTER `engr_req_details`, ADD `delivered_date` DATE NULL DEFAULT NULL AFTER `is_delivered`, ADD `delivered_comment` TEXT NULL DEFAULT NULL AFTER `delivered_date`, ADD `delivered_by` BIGINT NULL DEFAULT NULL AFTER `delivered_comment`;