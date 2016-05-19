core = 8.x
api = 2

defaults[projects][subdir] = "contrib"

; Contrib modules
projects[layout_plugin][version] = 1.0-alpha22
projects[ctools][version] = 3.0-alpha22
projects[twitter_block][version] = 2.1
projects[linkicon][version] = '1.2'
projects[pathauto][version] = '1.0-alpha1'
projects[token][version] = '1.0-alpha2'
projects[workbench_moderation][version] = '1.0'
projects[metatag][version] = '1.x-dev'
projects[agls][version] = '1.x-dev'
projects[scheduled_updates][version] = '1.0-alpha5'
projects[simple_sitemap][version] = '2.2'
projects[video_embed_field][version] = '1.0-rc7'
projects[embed][version] = '1.0-rc1'

projects[panels][version] = 3.0-beta2
projects[panels][patch][] = https://www.drupal.org/files/issues/2699529-quote-colons-beta4-3.patch

; Development versions
projects[better_normalizers][type] = module
projects[better_normalizers][download][type] = git
projects[better_normalizers][download][url] = https://git.drupal.org/sandbox/sam/2705067.git
projects[better_normalizers][download][branch] = 8.x-1.x
projects[better_normalizers][download][revision] = 1cd9b4b50e91f5e595eb86813611dc368227c4b6

projects[page_manager][type] = module
projects[page_manager][download][type] = git
projects[page_manager][download][url] = http://git.drupal.org/project/page_manager.git
projects[page_manager][download][branch] = 8.x-1.x
projects[page_manager][download][revision] = 8fa43f74d8ddb6d45f19de536ac61c9a8aea4946
; https://www.drupal.org/node/2601004
projects[page_manager][patch][] = https://www.drupal.org/files/issues/page-manager-contextual-temp.patch

projects[title][type] = module
projects[title][download][type] = git
projects[title][download][url] = http://git.drupal.org/project/title.git
projects[title][download][branch] = 8.x-2.x
projects[title][download][revision] = b163e2d50b3add3842ac67ea11cced5eb5d7ceaf

projects[fences][type] = module
projects[fences][download][type] = git
projects[fences][download][url] = http://git.drupal.org/project/fences.git
projects[fences][download][branch] = 8.x-2.x
projects[fences][download][revision] = e034397383724236453342cbc0a498193b607c00

projects[password_policy][type] = module
projects[password_policy][download][type] = git
projects[password_policy][download][url] = http://git.drupal.org/project/password_policy.git
projects[password_policy][download][branch] = 8.x-3.x
projects[password_policy][download][revision] = 40f8e14bb6759ac201bffec0c5ffd0b4361c3e5b
projects[password_policy][patch][] = https://www.drupal.org/files/issues/2692709-undefined-indexes.patch
projects[password_policy][patch][] = https://www.drupal.org/files/issues/2697777-php7-1.patch

projects[media_entity][type] = module
projects[media_entity][download][type] = git
projects[media_entity][download][url] = https://git.drupal.org/project/media_entity.git
projects[media_entity][download][branch] = 8.x-1.x
projects[media_entity][download][revision] = 040c5ffbca99aba64bdf686923df20b7251e3cb8
projects[media_entity][patch][] = https://www.drupal.org/files/issues/2705193-thumbnail-owner-2.patch
projects[media_entity][patch][] = https://www.drupal.org/files/issues/2705351-fix-method-call.patch

projects[media_entity_image][type] = module
projects[media_entity_image][download][type] = git
projects[media_entity_image][download][url] = https://git.drupal.org/project/media_entity_image.git
projects[media_entity_image][download][branch] = 8.x-1.x
projects[media_entity_image][download][revision] = b9608766b7ff582841b6c9083aa1037734c1b7d7

projects[entity_embed][type] = module
projects[entity_embed][download][type] = git
projects[entity_embed][download][url] = https://git.drupal.org/project/entity_embed.git
projects[entity_embed][download][branch] = 8.x-1.x
projects[entity_embed][download][revision] = 509fc57267e80371581ba8a65b3a4b68fe9add3e

projects[inline_entity_form][type] = module
projects[inline_entity_form][download][type] = git
projects[inline_entity_form][download][url] = https://git.drupal.org/project/inline_entity_form.git
projects[inline_entity_form][download][branch] = 8.x-1.x
projects[inline_entity_form][download][revision] = 274143d6748b8aaa02eb9dcc3296bf17ffddeee3

projects[entity_browser][type] = module
projects[entity_browser][download][type] = git
projects[entity_browser][download][url] = https://git.drupal.org/project/entity_browser.git
projects[entity_browser][download][branch] = 8.x-1.x
projects[entity_browser][download][revision] = 5b72762aa220d8dcdd1e3414d29f1b6634af4c35
projects[entity_browser][patch][] = https://www.drupal.org/files/issues/2710579-widget-config-schema.patch

projects[media_entity_browser][type] = module
projects[media_entity_browser][download][type] = git
projects[media_entity_browser][download][url] = https://git.drupal.org/project/media_entity_browser.git
projects[media_entity_browser][download][branch] = 8.x-1.x
projects[media_entity_browser][download][revision] = 4abc37fcc374db7e5bd261e6c905d516e8e2f8b9

; Development Modules
projects[config_devel][version] = '1.0-rc1'
projects[config_devel][subdir] = 'development'

projects[default_content][type] = module
projects[default_content][download][type] = git
projects[default_content][download][url] = http://git.drupal.org/project/default_content.git
projects[default_content][download][branch] = 8.x-1.x
projects[default_content][download][revision] = 471bf110e40e22b8a5ed10973825959aa33b2f21
projects[default_content][subdir] = 'development'
