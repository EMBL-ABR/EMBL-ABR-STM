from django.contrib import admin

# Register your models here.

from .models import Query
from .models import Source

admin.site.register(Query)
admin.site.register(Source)
