from __future__ import unicode_literals

from django.db import models

# Create your models here.

class Query(models.Model):
    search_term = models.CharField(max_length=100)
    page_num = models.SmallIntegerField()
    time_queried = models.DateTimeField()
    item_name = models.CharField(max_length=500)
    item_link = models.CharField(max_length=300)
    item_site = models.CharField(max_length=200)
    item_description = models.TextField()

    def __str__(self):
        return self.search_term + " - " + self.page_num

class Source(models.Model):
    source_url = models.CharField(max_length=300)
    is_australian = models.BooleanField(default=False)

    def __str__(self):
        return self.source_url

class Request(models.Model):
    email = models.CharField(max_length=300)
    source_url = models.CharField(max_length=300)

    def __str__(self):
        return self.source_url
