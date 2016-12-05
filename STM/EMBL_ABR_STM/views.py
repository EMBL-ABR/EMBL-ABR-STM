from django.shortcuts import render
from django.template import loader

# Create your views here.
from django.http import HttpResponse


def index(request):
    template = loader.get_template('index.html')
    context = {"active_page" : "index"}
    return HttpResponse(template.render(context, request))

def about(request):
    template = loader.get_template('about.html')
    context = {"active_page" : "about"}
    return HttpResponse(template.render(context, request))
    return HttpResponse(template.render(context, request))
