<!-- Begin PHP SEO tag v<?php echo $this->version ?> -->
<?php if (!empty($this->tags['page_title'])) { ?>  <title><?php echo $this->tags['page_title'] ?></title> <?php } ?>

<?php if (!empty($this->tags['generator'])) { ?>  <meta name="generator" content="<?php echo $this->tags['generator'] ?>" /> <?php } ?>

<?php if (!empty($this->tags['page_title'])) { ?>  <meta property="og:title" content="<?php echo $this->tags['page_title'] ?>" /> <?php } ?>

<?php if (!empty($this->tags['author'])) { ?>  <meta name="author" content="<?php echo $this->tags['author'] ?>" /> <?php } ?>

<?php if (!empty($this->tags['lang'])) { ?>  <meta property="og:locale" content="<?php echo $this->tags['lang'] ?>" /> <?php } ?>

<?php if (!empty($this->tags['description'])) { ?>  <meta name="description" content="<?php echo $this->tags['description'] ?>" />
  <meta property="og:description" content="<?php echo $this->tags['description'] ?>" />
 <?php } ?>

<?php if (!empty($this->tags['url'])) { ?>  <link rel="canonical" href="<?php echo $this->tags['url'] ?>" />
  <meta property="og:url" content="<?php echo $this->tags['url'] ?>" /> <?php } ?>

<?php if (!empty($this->tags['site_title'])) { ?>  <meta property="og:site_name" content="<?php echo $this->tags['site_title'] ?>" /> <?php } ?>

<?php if (!empty($this->tags['image'])) { ?>
<?php if (is_array($this->tags['image'])) { ?>
<?php if (!empty($this->tags['image']['path'])) { ?>  <meta property="og:image" content="<?php echo $this->tags['image']['path'] ?>" /> 
<?php if (!empty($this->tags['image']['height'])) { ?>  <meta property="og:image:height" content="<?php echo $this->tags['image']['height'] ?>" />
<?php } ?> <?php if (!empty($this->tags['image']['width'])) { ?> <meta property="og:image:width" content="<?php echo $this->tags['image']['width'] ?>" /> <?php } ?>
<?php } ?>
<?php } else { ?>
  <meta property="og:image" content="<?php echo $this->tags['image'] ?>" /><?php } ?>
<?php } ?>

<?php if (!empty($this->tags['date'])) { ?>
<?php if (is_array($this->tags['date'])) { ?>
<?php if (!empty($this->tags['date']['published'])) { ?>
  <meta property="og:type" content="article" />
  <meta property="article:published_time" content="<?php echo $this->tags['date']['published'] ?>" />
  <?php } ?>
<?php } else { ?>
  <meta property="og:type" content="article" />
  <meta property="article:published_time" content="<?php echo $this->tags['date'] ?>" />
  <?php } ?>
<?php } ?>

<?php if (!empty($this->tags['previous_page'])) { ?>
  <link rel="prev" href="<?php echo $this->tags['previous_page'] ?>">
<?php } ?>
<?php if (!empty($this->tags['next_page'])) { ?>
  <link rel="next" href="<?php echo $this->tags['next_page'] ?>">
<?php } ?>

<?php if (!empty($this->tags['twitter']['username'])) { ?>
<?php if (!empty($this->tags['image']['path'])) { ?>
  <meta name="twitter:card" content="summary_large_image" />
<?php } else { ?>
  <meta name="twitter:card" content="summary" />
<?php } ?>
  <meta name="twitter:site" content="@<?php echo $this->tags['twitter']['username'] ?>" />
<?php if (!empty($this->tags['twitter']['username'])) { ?>
  <meta name="twitter:creator" content="@<?php echo $this->tags['twitter']['username'] ?>" />
<?php } ?>
<?php } ?>

<?php if (!empty($this->tags['facebook'])) { ?>
<?php if (!empty($this->tags['facebook']['admins'])) { ?>
  <meta property="fb:admins" content="<?php echo $this->tags['facebook']['admins'] ?>" />
<?php } ?>
<?php if (!empty($this->tags['facebook']['publisher'])) { ?>
  <meta property="article:publisher" content="<?php echo $this->tags['facebook']['publisher'] ?>" />
<?php } ?>
<?php if (!empty($this->tags['facebook']['app_id'])) { ?>
  <meta property="fb:app_id" content="<?php echo $this->tags['facebook']['app_id'] ?>" />
<?php } ?>
<?php } ?>

<?php if (!empty($this->tags['google_site_verification']) or !empty($this->tags['webmaster_verifications']['google'])) { ?>
  <meta name="google-site-verification" content="<?php if (!empty($this->tags['google_site_verification'])) { echo $this->tags['google_site_verification']; } else { echo $this->tags['webmaster_verifications']['google']; } ?>">
<?php } ?>
<?php if (!empty($this->tags['webmaster_verifications']['bing'])) { ?>
  <meta name="msvalidate.01" content="<?php echo $this->tags['webmaster_verifications']['bing'] ?>">
<?php } ?>
<?php if (!empty($this->tags['webmaster_verifications']['alexa'])) { ?>
  <meta name="alexaVerifyID" content="<?php echo $this->tags['webmaster_verifications']['alexa'] ?>">
<?php } ?>
<?php if (!empty($this->tags['webmaster_verifications']['yandex'])) { ?>
  <meta name="yandex-verification" content="<?php echo $this->tags['webmaster_verifications']['yandex'] ?>">
<?php } ?>

  <script type="application/ld+json">
    <?php echo $this->jsonLd() ?>

  </script>

<!-- End PHP SEO tag -->
