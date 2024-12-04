using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Net.Http;
using Newtonsoft.Json;


namespace ApiCaller
{
    internal class Program
    {
        static void Main(string[] args)
        {
            using (HttpClient httpClient = new HttpClient())
            {


                try
                {
                    Console.WriteLine("Buscador de productos");
                    Console.WriteLine("Numero 1: ");
                    float numero1 = float.Parse(Console.ReadLine());
                    Console.WriteLine("Numero 2: ");
                    float numero2 = float.Parse(Console.ReadLine());
                    String url = $"http://localhost/apis/suma.php?numero1={numero1}&numero2={numero2}";
                    Console.WriteLine(url);
                    HttpResponseMessage respuesta = httpClient.GetAsync(url).Result;
                    String json = respuesta.Content.ReadAsStringAsync().Result;
                    //Console.WriteLine(respuesta);
                    var response = JsonConvert.DeserializeObject<MyApiResponse>(json);
                    Console.WriteLine(response.result);

                }
                catch (Exception e)
                {
                    Console.WriteLine($"Error al llamar API {e}");
                }
                finally 
                {
                    Console.ReadLine(); 
                }
            }
        }
    }

class MyApiResponse
    {

        public float result
        {
            get; set;
        }
        public float status
        {
            get; set;
        }
    }
}

