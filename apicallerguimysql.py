from tkinter import Tk, Label, Entry, Button, PhotoImage
from tkinter.ttk import Combobox
import requests

valores = ""

#Declaramos la función
def LlamarApi():
    try:
        codigo = int(codigopostal.get())
        url = f"http://localhost/apis/colonias.php?codigo={codigo}"
        response = requests.get(url)
        responsedata = response.json()
        valores = responsedata["data"]
        combo["values"] = valores
        combo.set(valores[0])
        label3["text"] = ""
    except ValueError:
        label3["text"] = "La respuesta no es un JSON válido."

ventana = Tk()
ventana.geometry("300x200")
ventana.title("Actividad 14: Python – GUI – API MySQL.")
ventana["bg"] = "#c6c6c6"

# Cargar el icono personalizado en formato .png (o .gif)
icono = PhotoImage(file="icono.png")

# Establecer el icono de la ventana
ventana.iconphoto(True, icono)

label1 = Label(ventana, text = "Código Postal")
label1.place(x = 10, y = 30)
codigopostal = Entry(ventana)
codigopostal.place(x = 100, y = 30)

button = Button(ventana, text = "Obtener código postal", command=LlamarApi)
button.place(x = 10, y = 90)

label3 = Label(ventana, text = "")
label3.place(x = 10, y = 130)

combo = Combobox(ventana, values=valores, state="readonly")
combo.place(x = 10, y = 160)

# Esta línea siempre va al final del archivo.
ventana.mainloop()