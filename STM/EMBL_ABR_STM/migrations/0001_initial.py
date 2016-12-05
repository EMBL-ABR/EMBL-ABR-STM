# -*- coding: utf-8 -*-
# Generated by Django 1.10.3 on 2016-12-03 02:52
from __future__ import unicode_literals

from django.db import migrations, models


class Migration(migrations.Migration):

    initial = True

    dependencies = [
    ]

    operations = [
        migrations.CreateModel(
            name='Query',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('search_term', models.CharField(max_length=100)),
                ('page_num', models.SmallIntegerField()),
                ('time_queried', models.DateTimeField()),
                ('item_name', models.CharField(max_length=500)),
                ('item_link', models.CharField(max_length=300)),
                ('item_site', models.CharField(max_length=200)),
                ('item_description', models.TextField()),
            ],
        ),
    ]
