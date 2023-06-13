namespace CSharpDiscovery.Quest04
{
    public class Car : Vehicule
    {
        public string Model { get; set; }

        public Car() : base()
        {
            Brand = "Unknown";
            Model = "Unknown";
        }

        public Car(string model, string brand, string color, int speed = 0) : base()
        {
            Model = model;
            Brand = brand;
            Color = color;
            CurrentSpeed = speed;
        }

        public override string ToString()
        {
            return String.Format("{0} {1} {2}", Color, Brand, Model);
        }

        public override void Accelerate(int Speed)
        {
            if (CurrentSpeed + Speed > 180)
            {
                CurrentSpeed = 180;
            }
            else
            {
                CurrentSpeed += Speed;
            }
        }

        public override void Brake(int Speed)
        {
            if (CurrentSpeed - Speed < 0)
            {
                CurrentSpeed = 0;
            }
            else
            {
                CurrentSpeed -= Speed;
            }
        }
    }
}
