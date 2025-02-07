function slug(event, slugField) {
  const title = event.target.value;
  const slug = title.toLowerCase().replace(/[\s_,]+/g, "-");
  slugField.val(slug);
}
