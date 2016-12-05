from django import forms

class RequestForm(forms.Form):
    input_email = forms.CharField(label='Your email address', max_length=300)
    input_source = forms.CharField(label='The URL to include', max_length=300)
