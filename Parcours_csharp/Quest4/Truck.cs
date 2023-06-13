namespace CSharpDiscovery.Quest04
{
    public class Truck : Vehicule
    {
        public int Tonnage { get; set; }

        public Truck() : base()
        {
            Tonnage = 0;
        }

        public Truck(int tonnage, string brand, string color, int currentSpeed) : base()
        {
            Tonnage = tonnage;
            Brand = brand;
            Color = color;
            CurrentSpeed = currentSpeed;
        }

        public override string ToString()
        {
            return String.Format("{0} {1} {2}T Truck", Color, Brand, Tonnage);
        }

        public override void Accelerate(int Speed)
        {
            if (CurrentSpeed + Speed > 100)
            {
                CurrentSpeed = 100;
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
