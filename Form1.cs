using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Windows.Forms.VisualStyles;
using System.Net.Http;
using Newtonsoft.Json;

namespace ApiCallerCodigo
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        
        private void button1_Click(object sender, EventArgs e)
        {
            try
            {
                int codigo = int.Parse(textBox1.Text);
                label2.Text = "";
                using (HttpClient httpClient = new HttpClient())
                {
                    try
                    {
                        String url = $"http://localhost/apis/colonias.php?codigo={codigo}";
                        //MessageBox.Show(url);
                        HttpResponseMessage respuesta = httpClient.GetAsync(url).Result;
                        String json = respuesta.Content.ReadAsStringAsync().Result;
                        //MessageBox.Show(respuesta.ToString());
                        var response = JsonConvert.DeserializeObject<MyApiResponse>(json);
                        //MessageBox.Show(String.Join(" ", response.data));
                        comboBox1.DataSource = response.data;
                    }
                    catch (Exception error)
                    {
                        label2.Text = $"Error al llamar API {error}";
                    }
                   
                }
            }
            catch (Exception)
            {
                label2.Text = "Error: El codigo postal no es un numero entero";
            }
        }
    }

    class MyApiResponse
    {

        public String[] data
        {
            get; set;
        }
        public float status
        {
            get; set;
        }
    }
}
