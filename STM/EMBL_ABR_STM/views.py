from django.shortcuts import render
from django.template import loader

# Create your views here.
from django.http import HttpResponse

from .models import Source

def index(request):
    template = loader.get_template('index.html')
    context = {"active_page" : "index"}
    return HttpResponse(template.render(context, request))

def about(request):
    template = loader.get_template('about.html')
    context = {"active_page" : "about"}
    return HttpResponse(template.render(context, request))

def sources(request):
    sources_list = list(Source.objects.order_by('-is_australian'))
    #sources_list = Source.objects.all()
    print(sources_list)
    template = loader.get_template('sources.html')
    context = {"active_page" : "sources", "sources_list" : sources_list}
    return HttpResponse(template.render(context, request))

def contact(request):
    template = loader.get_template('contact.html')
    context = {"active_page" : "contact"}
    return HttpResponse(template.render(context, request))
