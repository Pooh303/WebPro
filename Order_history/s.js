function createOrderElement(order) {
  const container = document.createElement("div");
  container.classList.add("order-container");

  // Order Image
  const img = document.createElement("img");
  img.src = order.image;
  img.alt = "Order Image";
  container.appendChild(img);

  // Order Details
  const details = document.createElement("div");
  details.classList.add("order-details");
  container.appendChild(details);

  const orderInfo = document.createElement("p");
  orderInfo.textContent = `Order #${order.id}`;
  details.appendChild(orderInfo);

  const placed = document.createElement("p");
  placed.textContent = `Placed: ${order.placed}`;
  details.appendChild(placed);

  const orderDetails = document.createElement("p");
  orderDetails.textContent = `Details: ${order.details}`;
  details.appendChild(orderDetails);

  // Order Status
  const status = document.createElement("div");

  switch (order.orderStatus.toLowerCase()) {
    case "empty":
      status.classList.add("empty", order.status.replace(/\s/g, ''));
      break;
    case "doing":
      status.classList.add("doing", order.status.replace(/\s/g, ''));
      break;
    case "finish":
      status.classList.add("finish", order.status.replace(/\s/g, ''));
      break;
    default:
      // Handle other cases
      break;
  }

  status.textContent = order.orderStatus;
  container.appendChild(status);

  return container;
}
