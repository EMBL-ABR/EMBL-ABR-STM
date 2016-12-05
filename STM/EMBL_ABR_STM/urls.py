from django.conf.urls import url

from . import views

urlpatterns = [
    url(r'^$', views.index, name='index'),
    url(r'^about/$', views.about, name='about'),
    url(r'^sources/$', views.sources, name='sources'),
    url(r'^contact/$', views.contact, name='contact'),
    url(r'^source_submitted/$', views.source_submitted, name='source_submitted'),
]
